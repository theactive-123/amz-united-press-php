/* AMZ United Press — site behaviour (vanilla JS, no framework).
   Data for the cover maker / shelf is printed by PHP into window.AMZ (see includes/footer.php).
   Sections: helpers · quote dialog · bookshelf · cover maker · proof demo · services tabs ·
   scroll effects · navigation · init. */
var RM=window.matchMedia&&matchMedia('(prefers-reduced-motion: reduce)').matches;
var _uid=0;function uid(){return 'u'+(++_uid)}
function clamp(n,a,b){return Math.max(a,Math.min(b,n))}
var WORK=(window.AMZ&&AMZ.work)||[],GENRES=(window.AMZ&&AMZ.genres)||[],SVCSET=(window.AMZ&&AMZ.svcset)||[''];

/* ---- confetti (small celebration after a form is sent) ---- */
function confetti(from){
  if(RM||!document.body.animate)return;
  var r=from.getBoundingClientRect(),cx=r.left+r.width/2,cy=r.top+r.height/3,cols=['#F29102','#141413','#FBFAF7','#C25400'];
  for(var i=0;i<22;i++){
    var s=document.createElement('i');s.className='spark';s.style.cssText='left:'+cx+'px;top:'+cy+'px;background:'+cols[i%cols.length]+';width:'+(5+Math.random()*4)+'px;height:'+(5+Math.random()*4)+'px;z-index:2000';
    document.body.appendChild(s);
    var a=Math.random()*Math.PI*2,d=70+Math.random()*130;
    s.animate([{transform:'translate(0,0) rotate(0)',opacity:1},{transform:'translate('+Math.cos(a)*d+'px,'+(Math.sin(a)*d+160)+'px) rotate('+(Math.random()*720-360)+'deg)',opacity:0}],{duration:1100+Math.random()*700,easing:'cubic-bezier(.1,.7,.3,1)'}).onfinish=(function(n){return function(){n.remove()}})(s);
  }
}

/* ---- quote dialog (the form lives in partials/quote-dialog.php) ---- */
var QD=$('#quoteDialog');
function openQuote(pref,helpIdx){
  if(!QD)return;
  var host=$('[data-form-host="quote"]',QD)||QD,card=$('.form-card',host),form=$('form',host);
  if(card.classList.contains('is-done')){form.reset();$$('.field',form).forEach(function(f){f.classList.remove('filled','invalid')});card.classList.remove('is-done')}
  var pr=$('[name="project"]',form);if(pref){pr.value=pref;pr.closest('.field').classList.add('filled')}
  if(helpIdx!==undefined&&helpIdx!==''&&helpIdx!==null){var sel=$('[name="help"]',form);sel.selectedIndex=+helpIdx+1;if(window.validateField)validateField(form,'help')}
  if(QD.showModal)QD.showModal();else QD.setAttribute('open','');
  setTimeout(function(){$('[name="name"]',form).focus()},60);
}

/* ---- bookshelf ---- */
function colsNow(){var w=innerWidth;return w<560?2:w<800?3:w<1100?4:6}
function initShelf(tabsEl,hostEl,limit){
  var cur='Recent';
  tabsEl.innerHTML=GENRES.map(function(g,i){return '<button type="button" role="tab" class="tab" id="tb-'+tabsEl.dataset.tabs+i+'" aria-selected="'+(i===0)+'" tabindex="'+(i===0?0:-1)+'" data-g="'+esc(g)+'">'+esc(g)+'</button>'}).join('');
  function show(){
    var list=WORK.map(function(w,i){return {w:w,i:i}}).filter(function(o){return cur==='Recent'?o.w.r:o.w.g===cur});
    if(limit)list=list.slice(0,limit);
    var c=colsNow(),rows='';
    for(var k=0;k<list.length;k+=c){
      rows+='<div class="srow" style="--cols:'+c+'">'+list.slice(k,k+c).map(function(o){return '<button type="button" class="sb" data-i="'+o.i+'" aria-label="'+esc(o.w.t)+' by '+esc(o.w.by)+', '+esc(o.w.g)+'">'+bookHTML(o.w,uid())+'<span class="lbl">'+esc(o.w.t)+'</span><span class="book-author">'+esc(o.w.by)+'</span>'+reviewHTML(o.w)+'</button>'}).join('')+'</div>';
    }
    hostEl.innerHTML=rows;
    hostEl.setAttribute('aria-labelledby',$('[aria-selected="true"]',tabsEl).id);
  }
  tabsEl.addEventListener('click',function(e){
    var t=e.target.closest('.tab');if(!t)return;
    $$('.tab',tabsEl).forEach(function(x){x.setAttribute('aria-selected',x===t);x.tabIndex=x===t?0:-1});
    cur=t.getAttribute('data-g');show();
  });
  tabsEl.addEventListener('keydown',function(e){
    var tabs=$$('.tab',tabsEl),i=tabs.indexOf(document.activeElement);if(i<0)return;var n=-1;
    if(e.key==='ArrowRight')n=(i+1)%tabs.length;else if(e.key==='ArrowLeft')n=(i-1+tabs.length)%tabs.length;else if(e.key==='Home')n=0;else if(e.key==='End')n=tabs.length-1;
    if(n>=0){e.preventDefault();tabs[n].focus();tabs[n].click()}
  });
  hostEl.addEventListener('click',function(e){var b=e.target.closest('.sb');if(b)openWork(WORK[+b.getAttribute('data-i')])});
  var last=colsNow();window.addEventListener('resize',function(){var c=colsNow();if(c!==last){last=c;show()}});
  show();
}
function initList(track){
  if(!WORK.length)return;
  var section=track.closest('.x-shelf'),belt=document.createElement('div'),paused=RM,hover=false,focused=false,touch=false,visible=false,hold=0,last=0,pos=0,cycle=0;
  belt.className='cover-belt';track.appendChild(belt);
  for(var group=0;group<3;group++)WORK.forEach(function(w,i){
    var card=document.createElement('button');card.type='button';card.className='li';card.dataset.i=i;
    card.setAttribute('aria-label',w.t+' by '+w.by );
    if(group!==1){card.tabIndex=-1;card.setAttribute('aria-hidden','true')}
    card.innerHTML='<span class="bkw">'+bookHTML(w,uid())+'</span><span class="li-meta"><span class="n">'+esc(w.g)+'</span><b>'+esc(w.t)+'</b><i>'+esc(w.by)+'</i>'+reviewHTML(w)+'</span>';
    belt.appendChild(card);
  });
  var cards=Array.from(belt.children);
  function highlight(){var width=track.clientWidth;cards.forEach(function(card){var distance=Math.abs(card.offsetLeft+card.offsetWidth/2-track.scrollLeft-width/2);card.style.opacity=String(1-.6*clamp((distance-width*.12)/(width*.5),0,1))})}
  function measure(){cycle=cards[WORK.length].offsetLeft-cards[0].offsetLeft;pos=cycle;track.scrollLeft=pos;highlight()}
  function go(d){hold=performance.now()+4500;track.scrollBy({left:d*(cards[0].offsetWidth+parseFloat(getComputedStyle(belt).gap)),behavior:RM?'auto':'smooth'})}
  $('#list-prev',section).addEventListener('click',function(){go(-1)});$('#list-next',section).addEventListener('click',function(){go(1)});
  track.addEventListener('pointerenter',function(e){if(e.pointerType==='mouse')hover=true});track.addEventListener('pointerleave',function(){hover=false});
  track.addEventListener('focusin',function(){focused=true});track.addEventListener('focusout',function(e){focused=track.contains(e.relatedTarget)});
  track.addEventListener('pointerdown',function(){touch=true;hold=performance.now()+4500});window.addEventListener('pointerup',function(){touch=false});window.addEventListener('pointercancel',function(){touch=false});
  track.addEventListener('wheel',function(){hold=performance.now()+4500},{passive:true});
  track.addEventListener('scroll',function(){if(cycle&&!focused){if(track.scrollLeft<cycle*.5)track.scrollLeft+=cycle;else if(track.scrollLeft>cycle*1.5)track.scrollLeft-=cycle}pos=track.scrollLeft;highlight()},{passive:true});
  track.addEventListener('keydown',function(e){if(e.key==='ArrowLeft'||e.key==='ArrowRight'){e.preventDefault();go(e.key==='ArrowLeft'?-1:1)}});
  track.addEventListener('click',function(e){var card=e.target.closest('.li');if(card)openWork(WORK[+card.dataset.i])});
  new ResizeObserver(measure).observe(track);new IntersectionObserver(function(es){visible=es[0].isIntersecting}).observe(track);measure();
  function animate(now){var elapsed=last?Math.min(now-last,50):0;last=now;
    if(visible&&!document.hidden&&!paused&&!hover&&!focused&&!touch&&now>hold&&!document.querySelector('dialog[open]')){pos-=elapsed*.025;if(pos<cycle*.5)pos+=cycle;track.scrollLeft=pos;highlight()}else pos=track.scrollLeft;
    requestAnimationFrame(animate);
  }requestAnimationFrame(animate);
}
function reviewHTML(w){return w.reviews==null?'':'<span class="book-reviews">'+Number(w.reviews).toLocaleString('en-US')+' reviews</span>'}
function openWork(w){
  var dlg=$('#workDialog');
  $('#dlgBody').innerHTML='<button type="button" class="modal-close" data-close aria-label="Close">'+ic('close')+'</button><div class="art">'+bookHTML(w,uid())+'</div><div class="m-body"><h2 id="dlgTitle" style="font-size:2.2rem">'+esc(w.t)+'</h2><p class="lead" style="font-size:1.1rem">by '+esc(w.by)+'</p>'+reviewHTML(w)+(w.description?'<p class="book-description">'+esc(w.description)+'</p>':'')+'<div class="btn-row" style="margin-top:26px"><button type="button" class="btn btn-primary" data-close data-quote="'+esc('I would like a book like '+w.t)+'">Discuss a similar book</button><button type="button" class="btn btn-light" data-close>Close</button></div></div>';
  if(dlg.showModal)dlg.showModal();else dlg.setAttribute('open','');
}

/* ---- hero: studio, audience, rotator ---- */
var STG=['Drama','Romance','Horror','Children’s Book','Travel','Health','Cookbook','Law','History','Biography','Comics'];
var ST={t:'The Quiet Harvest',by:'Helen Marsh',g:'Biography'},stRaf=0;
function renderStudio(){
  var w={t:(ST.t||'').trim()||'Your Title',g:ST.g,by:(ST.by||'').trim()||'Your Name',v:0};
  $('#st-book').innerHTML=bookHTML(w,'st'+(++_uid));
  var stt=$('#st-status');if(stt)stt.textContent='Showing “'+w.t+'” as a '+w.g.toLowerCase()+' concept cover.';
}
function segKeys(box){
  box.addEventListener('keydown',function(e){
    var b=$$('button',box),i=b.indexOf(document.activeElement),n=-1;if(i<0)return;
    if(e.key==='ArrowRight'||e.key==='ArrowDown')n=(i+1)%b.length;else if(e.key==='ArrowLeft'||e.key==='ArrowUp')n=(i-1+b.length)%b.length;
    if(n>=0){e.preventDefault();b[n].focus();b[n].click()}
  });
}
var AUDC={
  author:{lead:'New writer or published author, AMZ United Press gives you every self-publishing service in one place: ghostwriting, editing, cover design, formatting, Amazon publishing and book marketing. You stay the author, with 100% of your rights and royalties.',pop:[['ghostwriting-services','Ghostwriting'],['book-editing-services','Book editing'],['amazon-publishing-services','Amazon publishing']]},
  biz:{lead:'Turn your expertise into a book that builds authority and brings in clients. Our ebook writers draft thought-leadership titles, lead-magnet ebooks and company stories, then we publish and promote them for you.',pop:[['ebook-writing-services','Ebook writing'],['book-marketing-services','Book marketing'],['ebook-publishing-services','Ebook publishing']]}
};
function setAud(k){
  $$('[data-aud]').forEach(function(b){b.setAttribute('aria-checked',b.getAttribute('data-aud')===k)});
  var a=AUDC[k];$('#hero-lead').textContent=a.lead;
  $('#hero-pop').innerHTML=a.pop.map(function(p){return '<a class="pchip" href="'+((window.AMZ&&AMZ.base)||'')+'/services/'+p[0]+'">'+p[1]+' '+ic('arrow')+'</a>'}).join('');
}

/* ---- proof text ---- */
var ED={
  before:'Our company was founded in 2015 and we <span class="bad">has</span><sup class="mk">1</sup> helped over 100 <span class="bad">client’s</span><sup class="mk">2</sup> <span class="bad">to growing there</span><sup class="mk">3</sup> business. <span class="bad">We are very passionate and dedicated to excellence and we are always striving to be the best.</span><sup class="mk">4</sup>',
  after:'Founded in 2015, our company <span class="good">has helped</span><sup class="mk ok">1</sup> over 100 <span class="good">clients</span><sup class="mk ok">2</sup> <span class="good">grow their</span><sup class="mk ok">3</sup> business. <span class="good">We bring real passion and a commitment to excellence.</span><sup class="mk ok">4</sup>'
};
var EDN={
  before:['Subject and verb disagree: “we has”.','“Client’s” is possessive. The plural is “clients”.','“To growing there” should read “grow their”.','Wordy, and says very little.'],
  after:['The verb now agrees with its subject.','Plural, with no stray apostrophe.','Grammar fixed, and the sentence moves.','One confident sentence in place of three.']
};

/* ---- effects ---- */
var rvIO,cntIO;
function observeNew(root){
  root=root||document;
  $$('.rv',root).forEach(function(el){if(!el.dataset.o){el.dataset.o=1;rvIO.observe(el)}});
  $$('.fig b',root).forEach(function(el){cntIO.observe(el)});
}
function initEffects(){
  rvIO=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){var el=e.target;el.classList.add('in');rvIO.unobserve(el);setTimeout(function(){el.classList.add('done');el.style.transitionDelay=''},1500)}})},{threshold:.12,rootMargin:'0px 0px -6% 0px'});
  cntIO=new IntersectionObserver(function(es){es.forEach(function(e){if(!e.isIntersecting)return;cntIO.unobserve(e.target);var el=e.target,n=+el.dataset.n,suf=el.dataset.suf||'';if(RM){el.textContent=n+suf;return}var t0=performance.now();(function f(t){var p=clamp((t-t0)/1200,0,1);el.textContent=Math.round(n*(1-Math.pow(1-p,3)))+suf;if(p<1)requestAnimationFrame(f)})(t0)})},{threshold:.5});
  observeNew(document);
  /* scroll-scrubbed statement: words light up as you read */
  var scr=$$('.scrub');
  scr.forEach(function(el){var txt=el.textContent.trim().split(/\s+/);el.setAttribute('aria-label',el.textContent.trim());el.innerHTML=txt.map(function(w){return '<span aria-hidden="true"'+(RM?' class="lit"':'')+'>'+w+'</span>'}).join(' ');el._w=$$('span',el);el._n=RM?txt.length:0});
  var pxs=$$('.px');
  function parallax(){
    if(RM)return;
    var vh=innerHeight;
    pxs.forEach(function(el){
      if(el.offsetParent===null)return;
      var r=el.getBoundingClientRect();if(r.bottom<-200||r.top>vh+200)return;
      var f=parseFloat(el.dataset.px)||0.1,y=(r.top+r.height/2-vh/2)*-f;
      var lim=r.height*0.09;y=clamp(y,-lim,lim);
      var im=el.firstElementChild;if(im)im.style.transform='translate3d(0,'+y.toFixed(1)+'px,0)';
    });
    scr.forEach(function(el){
      if(el.offsetParent===null)return;
      var r=el.getBoundingClientRect(),p=clamp((vh*0.88-r.top)/(r.height+vh*0.3),0,1),n=Math.round(p*el._w.length);
      if(n!==el._n){for(var i=0;i<el._w.length;i++)el._w[i].classList.toggle('lit',i<n);el._n=n}
    });
  }
  var hdr=$('.site-header'),prog=$('#progress'),jr=$('#journey'),jbar=$('#jbar'),JN=jr?$$('.jstep',jr).length:0,ticking=false,wide=matchMedia('(min-width:941px)'),jcur=-1;
  function onScroll(){
    ticking=false;
    var y=window.scrollY,max=document.documentElement.scrollHeight-innerHeight;
    if(prog)prog.style.transform='scaleX('+(max>0?clamp(y/max,0,1):0)+')';
    if(hdr)hdr.classList.toggle('scrolled',y>40);
    parallax();
    if(jr&&jr.offsetParent!==null&&wide.matches&&!RM){
      var r=jr.getBoundingClientRect(),tot=jr.offsetHeight-innerHeight,p=clamp(-r.top/tot,0,.999),idx=Math.min(JN-1,Math.floor(p*JN));
      jbar.style.transform='scaleX('+p.toFixed(3)+')';
      if(idx!==jcur){jcur=idx;$$('.jstep',jr).forEach(function(el,i){el.classList.toggle('on',i===idx)});$$('#jprog [data-j]').forEach(function(b,i){if(i===idx)b.setAttribute('aria-current','step');else b.removeAttribute('aria-current')})}
    }
  }
  window.addEventListener('scroll',function(){if(!ticking){ticking=true;requestAnimationFrame(onScroll)}},{passive:true});
  window.addEventListener('resize',onScroll);window.__onScroll=onScroll;onScroll();
}


/* ---- proof demo: before / after editing ---- */
function initProof(){
  var paper=$('#paper');if(!paper)return;
  function showEd(k){paper.innerHTML='<p class="pane">'+ED[k]+'</p>';$$('[data-ed]').forEach(function(b){b.setAttribute('aria-checked',b.getAttribute('data-ed')===k)});
    $('#edit-notes').innerHTML=EDN[k].map(function(t,i){return '<li><b'+(k==='after'?' class="ok"':'')+'>'+(i+1)+'</b><span>'+t+'</span></li>'}).join('')}
  $$('[data-ed]').forEach(function(b){b.addEventListener('click',function(){showEd(b.getAttribute('data-ed'))})});
  segKeys($('.seg[aria-label="Show the paragraph"]'));showEd('before');
}

/* ---- home: cover maker, audience switch, rotating verb, services tabs, journey ---- */
function initHome(){
  if(!$('#studio'))return;
  $('#st-genres').innerHTML=STG.map(function(g){return '<button type="button" role="radio" class="gchip" aria-checked="'+(g===ST.g)+'" data-g="'+esc(g)+'">'+esc(g.replace(' Book',''))+'</button>'}).join('');
  renderStudio();
  $('#st-genres').addEventListener('click',function(e){var b=e.target.closest('.gchip');if(!b)return;ST.g=b.getAttribute('data-g');var bb=$('#st-book');bb.classList.remove('swap');void bb.offsetWidth;bb.classList.add('swap');$$('.gchip',this).forEach(function(x){x.setAttribute('aria-checked',x===b)});renderStudio()});
  segKeys($('#st-genres'));
  ['st-title','st-by'].forEach(function(id){$('#'+id).addEventListener('input',function(){ST[id==='st-title'?'t':'by']=this.value;if(!stRaf)stRaf=requestAnimationFrame(function(){stRaf=0;renderStudio()})})});
  var stg=$('#st-stage'),bk=$('#st-book');
  stg.addEventListener('pointermove',function(e){if(RM)return;var r=stg.getBoundingClientRect();bk.style.setProperty('--ry',(((e.clientX-r.left)/r.width-.5)*44).toFixed(1)+'deg');bk.style.setProperty('--rx',(-((e.clientY-r.top)/r.height-.5)*22).toFixed(1)+'deg')});
  stg.addEventListener('pointerleave',function(){bk.style.removeProperty('--ry');bk.style.removeProperty('--rx')});
  $('#st-go').addEventListener('click',function(){openQuote('Cover idea: “'+((ST.t||'').trim()||'Untitled')+'” by '+((ST.by||'').trim()||'(my name)')+' — genre: '+ST.g,2)});
  $$('[data-aud]').forEach(function(b){b.addEventListener('click',function(){setAud(b.getAttribute('data-aud'))})});
  segKeys($('.seg[aria-label="I am a…"]'));setAud('author');
  if(!RM){var W=['write','edit','design','publish','launch'],wi=0,rot=$('#rot');setInterval(function(){if(document.hidden)return;wi=(wi+1)%W.length;var n=rot.cloneNode(false);n.textContent=W[wi];rot.parentNode.replaceChild(n,rot);rot=n;n.id='rot'},2400)}
  /* services: four tabs, each with its own photo (markup is printed by PHP) */
  var toc=$('#xp');
  if(toc){
    var xsSel=function(i){$$('.xs-tab',toc).forEach(function(t,k){t.setAttribute('aria-selected',k===i);t.tabIndex=k===i?0:-1});$$('.xs-panel',toc).forEach(function(p,k){p.hidden=k!==i})};
    toc.addEventListener('click',function(e){var t=e.target.closest('.xs-tab');if(t)xsSel($$('.xs-tab',toc).indexOf(t))});
    toc.addEventListener('keydown',function(e){var tabs=$$('.xs-tab',toc),i=tabs.indexOf(document.activeElement);if(i<0)return;var n=-1;if(e.key==='ArrowRight')n=(i+1)%tabs.length;else if(e.key==='ArrowLeft')n=(i-1+tabs.length)%tabs.length;else if(e.key==='Home')n=0;else if(e.key==='End')n=tabs.length-1;if(n>=0){e.preventDefault();xsSel(n);tabs[n].focus()}});
  }
  /* journey: stage buttons scroll to a stage */
  var jp=$('#jprog');
  if(jp)jp.addEventListener('click',function(e){var b=e.target.closest('[data-j]');if(!b)return;var i=+b.getAttribute('data-j'),jr=$('#journey'),JN=$$('.jstep',jr).length;
    if(matchMedia('(min-width:941px)').matches&&!RM){window.scrollTo({top:jr.offsetTop+((i+.2)/JN)*(jr.offsetHeight-innerHeight),behavior:'smooth'})}else{var st=$$('.jstep',jr)[i];if(st)st.scrollIntoView({behavior:RM?'auto':'smooth'})}});
  /* genre shelf */
  
}

/* ---- navigation, dropdown, dialogs ---- */
var nav=$('#nav'),burger=$('#burger');
function setNav(open){
  if(!nav||!burger)return;
  nav.classList.toggle('open',open);burger.setAttribute('aria-expanded',open);burger.setAttribute('aria-label',open?'Close menu':'Open menu');
  burger.innerHTML='<svg class="ic" aria-hidden="true"><use href="#i-'+(open?'close':'menu')+'"/></svg>';
  if(open){var t=Math.round($('.hdr-in').getBoundingClientRect().bottom);nav.style.top=t+'px';nav.style.maxHeight=(innerHeight-t)+'px'}
}
if(burger)burger.addEventListener('click',function(){setNav(!nav.classList.contains('open'))});
document.addEventListener('keydown',function(e){if(e.key==='Escape'&&nav&&nav.classList.contains('open')){setNav(false);burger.focus()}});
function closeDlg(d){if(!d)return;if(d.close)d.close();else d.removeAttribute('open')}
document.addEventListener('click',function(e){
  var q=e.target.closest('[data-quote]');
  if(q){e.preventDefault();var wd=$('#workDialog');if(wd&&wd.open)closeDlg(wd);setNav(false);openQuote(q.getAttribute('data-quote'),q.getAttribute('data-help'));return}
  if(e.target.closest('[data-close]'))closeDlg($('#workDialog'));
  if(e.target.closest('[data-qclose]'))closeDlg(QD);
  if(e.target===$('#workDialog'))closeDlg(e.target);
  if(QD&&e.target===QD)closeDlg(QD);
  var j=e.target.closest('[data-jump]');
  if(j){var t=document.getElementById(j.getAttribute('data-jump'));if(t)t.scrollIntoView({behavior:RM?'auto':'smooth',block:'start'});$$('[data-jump]',j.closest('.lg-toc')).forEach(function(x){x.classList.toggle('on',x===j)})}
});
/* Header dropdowns: hover/focus opens them on desktop (CSS); the arrow buttons (and "Resources") toggle them by tap or keyboard. */
$$('.hdr-dd').forEach(function(li){
  var tog=$('.dd-tog',li),top=$('.hdr-top-btn',li);
  function set(open){$$('.hdr-dd.open').forEach(function(o){if(o!==li){o.classList.remove('open');$('.dd-tog',o).setAttribute('aria-expanded','false')}});li.classList.toggle('open',open);tog.setAttribute('aria-expanded',open)}
  tog.addEventListener('click',function(){set(!li.classList.contains('open'))});
  if(top)top.addEventListener('click',function(){set(!li.classList.contains('open'))});
  li.addEventListener('mouseleave',function(){if(matchMedia('(min-width:1181px)').matches)set(false)});
});
document.addEventListener('click',function(e){if(!e.target.closest('.hdr-dd'))$$('.hdr-dd.open').forEach(function(o){o.classList.remove('open');$('.dd-tog',o).setAttribute('aria-expanded','false')})});
document.addEventListener('keydown',function(e){if(e.key==='Escape')$$('.hdr-dd.open').forEach(function(o){o.classList.remove('open');$('.dd-tog',o).setAttribute('aria-expanded','false')})});
/* Live Chat: opens whichever chat widget is installed (Tawk.to, LiveChat, Tidio, Crisp, Zendesk); otherwise the quote form. */
document.addEventListener('click',function(e){
  var b=e.target.closest('[data-chat]');if(!b)return;e.preventDefault();setNav(false);
  var w=window;
  if(w.Tawk_API&&w.Tawk_API.maximize)return w.Tawk_API.maximize();
  if(w.LiveChatWidget&&w.LiveChatWidget.call)return w.LiveChatWidget.call('maximize');
  if(w.tidioChatApi&&w.tidioChatApi.open)return w.tidioChatApi.open();
  if(w.$crisp&&w.$crisp.push)return w.$crisp.push(['do','chat:open']);
  if(w.zE)return w.zE('messenger','open');
  openQuote('I’d like to chat about my book.');
});

/* ---- init ---- */
document.documentElement.classList.add('js');
var yr=$('#yr');if(yr)yr.textContent=new Date().getFullYear();
initHome();
$$('.x-shelf .list-track').forEach(initList);
initProof();
initEffects();

