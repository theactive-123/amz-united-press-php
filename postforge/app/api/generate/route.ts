// POST /api/generate — runs on the server only, so API keys never reach the browser.
// The real two-step generation is added in Stage 2.

export async function POST() {
  return Response.json(
    { error: "Post generation is not built yet. It arrives in Stage 2." },
    { status: 501 },
  );
}
