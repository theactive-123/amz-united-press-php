#!/usr/bin/env python3
"""Build the Metabolic Republic single-file site.

Outputs (in this folder):
  index.html                     one master HTML file, all pages + inline CSS/JS, images from assets/
  metabolic-republic-master.html same file, fully self-contained (images embedded, optimized)
  css/styles.css, js/main.js     the shared CSS/JS as separate files (handy for Webflow)

Usage:  python3 build.py
"""
import base64
import io
import os
import re

from PIL import Image

ROOT = os.path.dirname(os.path.abspath(__file__))
SRC = os.path.join(ROOT, "src")

PAGES = [
    "home", "about", "classes", "membership", "membership-b", "contact", "consultation",
    "landing", "new-client", "interview", "billing", "provider-redirect", "provider-login",
    "privacy", "terms",
]

# Max pixel width per embedded image (about 1.5-2x its largest display size).
MAX_W = {"hero": 2000, "tour": 2000, "first-month": 1300, "coach_assist_stretch": 1500,
         "movement-studio": 1500, "about-gallery-1": 1300}
DEFAULT_MAX_W = 900


def read(*parts):
    with open(os.path.join(SRC, *parts), encoding="utf-8") as f:
        return f.read()


def svg_inline(name, cls):
    svg = open(os.path.join(ROOT, "assets", "icons", name), encoding="utf-8").read()
    svg = re.sub(r'\s(preserveAspectRatio|overflow|style)="[^"]*"', "", svg, count=3)
    svg = svg.replace('fill="white"', 'fill="currentColor"')
    svg = svg.replace("<svg ", '<svg class="%s" aria-hidden="true" focusable="false" ' % cls, 1)
    svg = re.sub(r'\sid="[^"]*"', "", svg)  # avoid duplicate ids when repeated
    return svg.strip()


def assemble():
    logo = svg_inline("logo-mark.svg", "logo-svg")
    arrow_prev = svg_inline("arrow-prev.svg", "icon").replace('stroke="#1E2E2A" stroke-opacity="0.4"', 'stroke="currentColor"')
    arrow_next = svg_inline("arrow-next.svg", "icon").replace('stroke="#1E2E2A"', 'stroke="currentColor"')

    pages = "\n".join(read("pages", p + ".html") for p in PAGES)
    pages = pages.replace("{{WAITLIST}}", read("partials", "waitlist.html"))
    pages = pages.replace("{{ICON_PREV}}", arrow_prev).replace("{{ICON_NEXT}}", arrow_next)

    favicon_svg = svg_inline("logo-mark.svg", "f").replace('fill="currentColor"', 'fill="#1e2e2a"')
    favicon = "data:image/svg+xml;base64," + base64.b64encode(favicon_svg.encode()).decode()

    css = read("styles.css")
    js = read("main.js")
    html = read("shell.html")
    html = html.replace("{{PAGES}}", pages)
    html = html.replace("{{LOGO}}", logo)
    html = html.replace("{{FAVICON}}", favicon)
    html = html.replace("{{OG_IMAGE}}", "assets/img/hero-home.jpg")
    html = html.replace("{{STYLES}}", "<style>\n" + css.replace("../assets/", "assets/") + "\n</style>")
    html = html.replace("{{SCRIPT}}", "<script>\n" + js + "\n</script>")
    assert "{{" not in html, re.findall(r"\{\{\w+\}\}", html)
    return html, css, js


def optimized_data_uri(rel):
    path = os.path.join(ROOT, rel)
    ext = os.path.splitext(rel)[1].lower()
    if ext == ".svg":
        return "data:image/svg+xml;base64," + base64.b64encode(open(path, "rb").read()).decode()
    name = os.path.splitext(os.path.basename(rel))[0]
    max_w = next((w for k, w in MAX_W.items() if name.startswith(k)), DEFAULT_MAX_W)
    im = Image.open(path)
    if im.width > max_w:
        im = im.resize((max_w, round(im.height * max_w / im.width)), Image.LANCZOS)
    buf = io.BytesIO()
    if ext == ".png":
        im.save(buf, "PNG", optimize=True)
        mime = "image/png"
    else:
        im.convert("RGB").save(buf, "JPEG", quality=72, optimize=True, progressive=True)
        mime = "image/jpeg"
    return "data:%s;base64,%s" % (mime, base64.b64encode(buf.getvalue()).decode())


def inline_assets(html):
    cache = {}

    def repl(m):
        rel = m.group(1)
        if rel not in cache:
            cache[rel] = optimized_data_uri(rel)
        return cache[rel]

    # images referenced from HTML, CSS and the JS class data
    html = re.sub(r"(assets/(?:img|icons)/[\w\-.]+\.(?:jpg|png|svg))", repl, html)
    return html, cache


def main():
    html, css, js = assemble()
    os.makedirs(os.path.join(ROOT, "css"), exist_ok=True)
    os.makedirs(os.path.join(ROOT, "js"), exist_ok=True)
    open(os.path.join(ROOT, "css", "styles.css"), "w", encoding="utf-8").write(css)
    open(os.path.join(ROOT, "js", "main.js"), "w", encoding="utf-8").write(js)
    open(os.path.join(ROOT, "index.html"), "w", encoding="utf-8").write(html)

    master, cache = inline_assets(html)
    open(os.path.join(ROOT, "metabolic-republic-master.html"), "w", encoding="utf-8").write(master)
    print("index.html                     %7.1f KB" % (len(html.encode()) / 1024))
    print("metabolic-republic-master.html %7.1f MB (%d embedded assets)" % (len(master.encode()) / 1048576, len(cache)))


if __name__ == "__main__":
    main()
