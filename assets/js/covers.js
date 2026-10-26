/* AMZ United Press — concept covers drawn in code (SVG). Used by the cover maker and the shelf.
   They are illustrations, not client work. */
var $=function(s,r){return (r||document).querySelector(s)};
var $$=function(s,r){return Array.prototype.slice.call((r||document).querySelectorAll(s))};
function esc(s){return String(s).replace(/[&<>"]/g,function(c){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]})}
function ic(n){return '<svg class="ic" aria-hidden="true"><use href="#i-'+n+'"/></svg>'}

/* ---- book covers drawn in code ---- */
function star(cx,cy,ro,ri,n){var p=[];for(var i=0;i<n*2;i++){var r=i%2?ri:ro,a=Math.PI*i/n-Math.PI/2;p.push((cx+r*Math.cos(a)).toFixed(1)+','+(cy+r*Math.sin(a)).toFixed(1))}return p.join(' ')}

/* ============ CONCEPT COVERS ============
   Each genre has its own typeface, layout and image idea, drawn in code (no stock art).
   Two colourways per genre (v = 0 or 1). Titles are set live, so the cover maker works. */
var FF={fr:"Fraunces,Georgia,serif",dm:"'DM Serif Display',Georgia,serif",co:"'Cormorant Garamond',Georgia,serif",bb:"'Bebas Neue',Impact,sans-serif",sg:"'Space Grotesk',Arial,sans-serif",mo:"'JetBrains Mono',ui-monospace,monospace"};
var SUBL={'Drama':'A NOVEL','Romance':'A NOVEL','Horror':'A NOVEL','Children’s Book':'A PICTURE BOOK','Health':'A PRACTICAL GUIDE','Travel':'ESSAYS & JOURNEYS','Law':'A PLAIN-ENGLISH GUIDE','Cookbook':'RECIPES & STORIES','Biography':'A MEMOIR','History':'A HISTORY','Comics':'A GRAPHIC NOVEL'};
function wrapTitle(t,max){var w=t.split(' '),lines=[],cur='';w.forEach(function(x){if((cur+' '+x).trim().length>max&&cur){lines.push(cur);cur=x}else cur=(cur+' '+x).trim()});if(cur)lines.push(cur);return lines}
function fitT(t,o){var s=o.up?t.toUpperCase():t,lines=wrapTitle(s,o.mx),L=Math.max.apply(null,lines.map(function(l){return l.length})),fs=Math.min(o.fs,o.w/(L*o.cw),o.h/(lines.length*o.lh));return {lines:lines,fs:Math.max(fs,13),lh:o.lh}}
function TT(f,x,y,anc,fam,wt,sty,fill,ls,tr){return f.lines.map(function(l,i){var c=typeof fill==='function'?fill(i,f.lines.length):fill;return '<text x="'+x+'" y="'+(y+i*f.fs*f.lh).toFixed(1)+'" text-anchor="'+anc+'" font-family="'+fam+'" font-weight="'+wt+'" font-style="'+sty+'" font-size="'+f.fs.toFixed(1)+'" letter-spacing="'+ls+'" fill="'+c+'"'+(tr?' transform="'+tr+'"':'')+'>'+esc(l)+'</text>'}).join('')}
function LB(t,x,y,anc,fill,op,sz,ls){return '<text x="'+x+'" y="'+y+'" text-anchor="'+anc+'" font-family="'+FF.mo+'" font-weight="500" font-size="'+(sz||7)+'" letter-spacing="'+(ls||2)+'" fill="'+fill+'" opacity="'+(op===undefined?.8:op)+'">'+t+'</text>'}
function AU(w,x,anc,fill){return LB(esc((w.by||'').toUpperCase()),x,372,anc,fill,.95,8.5,2.2)+LB('AMZ UNITED PRESS',x,386,anc,fill,.5,5,2.4)}
function qp(P0,P1,P2,t){var u=1-t;return [u*u*P0[0]+2*u*t*P1[0]+t*t*P2[0],u*u*P0[1]+2*u*t*P1[1]+t*t*P2[1]]}

var COV={
 Drama:function(w,id,v){
  var c=v?{bg:'#EFE6D3',sun:'#C2412D',ink:'#13232B'}:{bg:'#0F2F3A',sun:'#E9822B',ink:'#F3EBDD'},h=170,r='';
  for(var i=0;i<6;i++){var hw=54-i*8;r+='<rect x="'+(214-hw)+'" y="'+(h+8+i*8)+'" width="'+(hw*2)+'" height="2.4" fill="'+c.sun+'" opacity="'+(1-i*.15).toFixed(2)+'"/>'}
  var f=fitT(w.t,{mx:11,cw:.5,fs:46,w:244,h:96,lh:1.0});
  return '<rect width="300" height="400" fill="'+c.bg+'"/><clipPath id="cp'+id+'"><rect width="300" height="'+h+'"/></clipPath><circle cx="214" cy="'+(h-4)+'" r="58" fill="'+c.sun+'" clip-path="url(#cp'+id+')"/><rect y="'+h+'" width="300" height="1" fill="'+c.ink+'" opacity=".55"/>'+r+LB('A NOVEL',28,44,'start',c.ink,.75,7.5,2.6)+TT(f,28,270,'start',FF.fr,600,'italic',c.ink,-.6)+AU(w,28,'start',c.ink)},
 Romance:function(w,id,v){
  var c=v?{bg:'#241C33',ink:'#F4DCD4',st:'#C98B9A',lf:'#7C5B7A'}:{bg:'#EBCAC4',ink:'#4A1626',st:'#A8344B',lf:'#7E8F6A'},g='';
  [[96,128,214],[154,156,262],[212,110,236]].forEach(function(s,k){
   var P0=[s[0]-10+k*10,400],P1=[s[0]+(k-1)*28,330],P2=[s[0]+(k-1)*18,s[2]];
   g+='<path d="M'+P0[0]+' 400Q'+P1[0]+' '+P1[1]+' '+P2[0]+' '+P2[1]+'" stroke="'+c.lf+'" stroke-width="1.6" fill="none"/>';
   for(var j=1;j<6;j++){var t=j/6,p=qp(P0,P1,P2,t),a=(j%2?-1:1)*52+(k-1)*10;g+='<ellipse cx="'+p[0].toFixed(1)+'" cy="'+p[1].toFixed(1)+'" rx="4.5" ry="12" fill="'+c.lf+'" opacity=".85" transform="rotate('+a+' '+p[0].toFixed(1)+' '+p[1].toFixed(1)+') translate(0 -8)"/>'}
   for(var q=0;q<6;q++)g+='<ellipse cx="'+P2[0]+'" cy="'+(P2[1]-12)+'" rx="7" ry="15" fill="'+c.st+'" opacity="'+(q%2?.9:.7)+'" transform="rotate('+(q*60)+' '+P2[0]+' '+P2[1]+')"/>';
   g+='<circle cx="'+P2[0]+'" cy="'+P2[1]+'" r="4.5" fill="'+c.ink+'" opacity=".85"/>'});
  var f=fitT(w.t,{mx:11,cw:.4,fs:58,w:252,h:140,lh:1.0});
  return '<rect width="300" height="400" fill="'+c.bg+'"/>'+g+'<rect y="350" width="300" height="50" fill="'+c.bg+'"/>'+LB('A NOVEL',150,52,'middle',c.ink,.8,7.5,3)+TT(f,150,112,'middle',FF.co,600,'italic',c.ink,-.4)+AU(w,150,'middle',c.ink).replace(/y="372"/,'y="372"')},
 Horror:function(w,id,v){
  var c=v?{bg:'#190E0F',ink:'#DDD5C6',red:'#9C1D1D'}:{bg:'#0B0B0B',ink:'#E9E4D6',red:'#C0281F'},k='';
  if(v){for(var i=0;i<9;i++){var a=(i*37+14)%160-80;k+='<line x1="212" y1="0" x2="'+(212+Math.tan(a*Math.PI/180)*400).toFixed(0)+'" y2="400" stroke="'+c.red+'" stroke-width=".7" opacity="'+(.15+(i%3)*.12)+'"/>'}}
  var f=fitT(w.t,{mx:9,cw:.4,fs:100,w:254,h:230,lh:.88,up:true});
  return '<defs><linearGradient id="sl'+id+'" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#fff" stop-opacity="0"/><stop offset=".5" stop-color="#fff" stop-opacity=".95"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></linearGradient><linearGradient id="fg'+id+'" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="'+c.bg+'" stop-opacity="0"/><stop offset="1" stop-color="'+c.bg+'" stop-opacity=".95"/></linearGradient></defs><rect width="300" height="400" fill="'+c.bg+'"/>'+k+'<rect x="136" width="28" height="400" fill="url(#sl'+id+')" opacity=".10"/><rect x="147.5" width="5" height="400" fill="url(#sl'+id+')" opacity=".9"/>'+LB('A NOVEL',24,44,'start',c.ink,.7,7.5,3)+TT(f,24,110,'start',FF.bb,400,'normal',function(i,n){return i===n-1&&n>1?c.red:c.ink},1.5)+'<rect y="290" width="300" height="110" fill="url(#fg'+id+')"/>'+AU(w,24,'start',c.ink)},
 'Children’s Book':function(w,id,v){
  var c=v?{bg:'#1F2D5A',ink:'#F6EBD0',orb:'#F6EBD0',h1:'#3B4F8F',h2:'#151F42',acc:'#F6C945'}:{bg:'#F7C948',ink:'#1F2A44',orb:'#F2784B',h1:'#46A08C',h2:'#2F6F62',acc:'#FFF3D6'},d='';
  [[40,210],[262,196],[70,262],[236,252],[30,300],[272,300],[182,226],[118,196]].forEach(function(s,i){d+=v?'<polygon points="'+star(s[0],s[1],i%2?4:5.5,1.6,4)+'" fill="'+c.acc+'"/>':'<circle cx="'+s[0]+'" cy="'+s[1]+'" r="'+(i%2?2.4:3.4)+'" fill="'+c.acc+'"/>'});
  var f=fitT(w.t,{mx:11,cw:.48,fs:48,w:248,h:104,lh:1.02});
  return '<rect width="300" height="400" fill="'+c.bg+'"/>'+d+'<circle cx="150" cy="248" r="'+(v?44:50)+'" fill="'+c.orb+'"/>'+(v?'<circle cx="168" cy="236" r="44" fill="'+c.bg+'"/>':'')+'<path d="M0 300C70 262 150 268 210 292S280 296 300 280V400H0z" fill="'+c.h1+'"/><path d="M0 338C80 308 190 316 300 342V400H0z" fill="'+c.h2+'"/><rect x="226" y="270" width="5" height="40" fill="'+c.h2+'"/><circle cx="228.5" cy="262" r="17" fill="'+c.h2+'"/>'+TT(f,150,76,'middle',FF.dm,400,'normal',c.ink,-.2)+AU(w,150,'middle',v?c.ink:'#FFF3D6')},
 Health:function(w,id,v){
  var c=v?{bg:'#14231B',ink:'#E9EEE6',ac:'#CFE36B'}:{bg:'#E8EDE4',ink:'#14231B',ac:'#2E6B4F'},C=2*Math.PI*84;
  var f=fitT(w.t,{mx:10,cw:.57,fs:42,w:248,h:112,lh:1.02});
  return '<rect width="300" height="400" fill="'+c.bg+'"/><circle cx="170" cy="262" r="62" fill="none" stroke="'+c.ink+'" stroke-width="1" opacity=".25"/><circle cx="170" cy="262" r="84" fill="none" stroke="'+c.ink+'" stroke-width="22" opacity=".1"/><circle cx="170" cy="262" r="84" fill="none" stroke="'+c.ac+'" stroke-width="22" stroke-dasharray="'+(C*.72).toFixed(1)+' '+C.toFixed(1)+'" transform="rotate(-90 170 262)"/><circle cx="170" cy="262" r="9" fill="'+c.ac+'"/>'+LB('A PRACTICAL GUIDE',26,42,'start',c.ink,.7,7.5,2.6)+TT(f,26,86,'start',FF.sg,700,'normal',c.ink,-1.2)+AU(w,26,'start',c.ink)},
 Travel:function(w,id,v){
  var c=v?{bg:'#F1E8D5',ink:'#12363F',ln:'#1B5E6B',sun:'#D9542B'}:{bg:'#0E4A5B',ink:'#F3EBDD',ln:'#F3EBDD',sun:'#F29102'},l='';
  for(var i=0;i<10;i++){var y=64+i*17,a=(i*13)%22;l+='<path d="M-10 '+y+'C50 '+(y-20+a/2)+' 110 '+(y+22-a/2)+' 170 '+y+'S260 '+(y-18+a/3)+' 310 '+(y+4)+'" fill="none" stroke="'+c.ln+'" stroke-width=".9" opacity="'+(.28+(i%3)*.14).toFixed(2)+'"/>'}
  var f=fitT(w.t,{mx:12,cw:.48,fs:40,w:244,h:76,lh:1.0});
  return '<rect width="300" height="400" fill="'+c.bg+'"/><circle cx="206" cy="132" r="38" fill="'+c.sun+'"/>'+l+LB('ESSAYS & JOURNEYS',28,44,'start',c.ink,.8,7.5,2.6)+TT(f,28,296,'start',FF.dm,400,'normal',c.ink,-.2)+AU(w,28,'start',c.ink)},
 Law:function(w,id,v){
  var c=v?{bg:'#E8E3D9',ink:'#15161A',sec:'#CFC8B8',or:'#E07F00'}:{bg:'#15161A',ink:'#F1EBDD',sec:'#26272E',or:'#F29102'};
  var f=fitT(w.t,{mx:11,cw:.57,fs:42,w:244,h:150,lh:1.02});
  return '<rect width="300" height="400" fill="'+c.bg+'"/><text x="352" y="440" text-anchor="end" font-family="'+FF.fr+'" font-weight="700" font-size="420" fill="'+c.sec+'">§</text><rect x="28" y="52" width="36" height="3" fill="'+c.or+'"/>'+LB('A PLAIN-ENGLISH GUIDE',28,40,'start',c.ink,.75,7,2.4)+TT(f,28,96,'start',FF.fr,700,'normal',c.ink,-.8)+AU(w,28,'start',c.ink)},
 Cookbook:function(w,id,v){
  var c=v?{bg:'#F3E7CF',ink:'#1F3558',rim:'#2B4C7E',pl:'#FFFDF6'}:{bg:'#D9482B',ink:'#FFF3DD',rim:'#B8381F',pl:'#FFF6E4'},fd='',cols=['#F2B134','#5B8C3A','#C2412D','#FFF3D6','#E97B3A'];
  for(var i=0;i<16;i++){var a=i*2.4,r=6+i*3.3;fd+='<circle cx="'+(150+Math.cos(a)*r).toFixed(1)+'" cy="'+(262+Math.sin(a)*r).toFixed(1)+'" r="'+(5+(i%4)*2.2)+'" fill="'+cols[i%5]+'"/>'}
  var f=fitT(w.t,{mx:11,cw:.46,fs:46,w:244,h:100,lh:1.0}),kc=v?c.ink:c.ink;
  return '<rect width="300" height="400" fill="'+c.bg+'"/><circle cx="150" cy="262" r="96" fill="'+c.pl+'"/><circle cx="150" cy="262" r="82" fill="none" stroke="'+c.rim+'" stroke-width="3"/>'+fd+'<g stroke="'+kc+'" stroke-width="2" stroke-linecap="round" opacity=".9"><path d="M30 222V250M38 222V250M46 222V250M30 250q8 8 16 0M38 250V318"/><path d="M262 222q10 0 10 30t-10 30M262 222V318"/></g>'+TT(f,150,82,'middle',FF.dm,400,'italic',c.ink,-.2)+AU(w,150,'middle',c.ink)},
 Biography:function(w,id,v){
  var c=v?{bg:'#233A34',ink:'#F1E9D4',a1:'#EADFC3',a2:'#C9BC98',sun:'#F29102'}:{bg:'#DAD4C8',ink:'#16201E',a1:'#2C4A44',a2:'#16201E',sun:'#F6D67E'};
  var f=fitT(w.t,{mx:9,cw:.39,fs:56,w:250,h:118,lh:1.0});
  return '<defs><linearGradient id="ag'+id+'" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="'+c.a1+'"/><stop offset="1" stop-color="'+c.a2+'"/></linearGradient><clipPath id="ac'+id+'"><path d="M110 346V300a80 80 0 0 1 160 0V346z"/></clipPath></defs><rect width="300" height="400" fill="'+c.bg+'"/><path d="M110 346V300a80 80 0 0 1 160 0V346z" fill="url(#ag'+id+')"/><g clip-path="url(#ac'+id+')"><circle cx="190" cy="288" r="22" fill="'+c.sun+'"/><path d="M100 326q50-26 100-6t80-14V420H100z" fill="'+c.bg+'" opacity=".55"/></g>'+'<rect x="110" y="346" width="160" height="1.2" fill="'+c.ink+'" opacity=".5"/>'+LB('A MEMOIR',28,44,'start',c.ink,.7,7.5,2.6)+TT(f,28,92,'start',FF.co,500,'italic',c.ink,-.5)+AU(w,28,'start',c.ink)},
 History:function(w,id,v){
  var c=v?{bg:'#E9DFC8',ink:'#3B2A1E',ln:'#8A6A3A'}:{bg:'#552A24',ink:'#F2E7CF',ln:'#D6B375'},g='';
  for(var k=1;k<6;k++)g+='<ellipse cx="150" cy="252" rx="'+Math.abs(84*Math.cos(k*Math.PI/6)).toFixed(1)+'" ry="84" fill="none" stroke="'+c.ln+'" stroke-width=".7" opacity=".75"/>';
  [-60,-30,0,30,60].forEach(function(p){var a=p*Math.PI/180,y=252+84*Math.sin(a),hw=84*Math.cos(a);g+='<line x1="'+(150-hw).toFixed(1)+'" y1="'+y.toFixed(1)+'" x2="'+(150+hw).toFixed(1)+'" y2="'+y.toFixed(1)+'" stroke="'+c.ln+'" stroke-width=".7" opacity=".75"/>'});
  var f=fitT(w.t,{mx:12,cw:.66,fs:34,w:236,h:100,lh:1.12,up:true});
  return '<rect width="300" height="400" fill="'+c.bg+'"/><rect x="16" y="16" width="268" height="368" fill="none" stroke="'+c.ln+'" stroke-width="1.4"/><rect x="23" y="23" width="254" height="354" fill="none" stroke="'+c.ln+'" stroke-width=".6"/><circle cx="150" cy="252" r="84" fill="none" stroke="'+c.ln+'" stroke-width="1.2"/>'+g+'<polygon points="'+star(150,252,12,3.6,8)+'" fill="'+c.ln+'"/>'+LB('A HISTORY',150,56,'middle',c.ink,.75,7,3)+TT(f,150,92,'middle',FF.co,600,'normal',c.ink,2.6)+AU(w,150,'middle',c.ink).replace(/y="372"/,'y="372"').replace('x="150" y="372"','x="150" y="368"')},
 Comics:function(w,id,v){
  var c=v?{bg:'#1F3FBF',burst:'#FFD23F',ink:'#0F1230',sh:'#E5399B',dot:'#0F1230'}:{bg:'#F29102',burst:'#FFF3D6',ink:'#141413',sh:'#C0281F',dot:'#141413'},d='';
  for(var y=0;y<9;y++)for(var x=0;x<14;x++)d+='<circle cx="'+(x*22+(y%2?11:0))+'" cy="'+(300+y*12)+'" r="'+(3.4-y*.3).toFixed(1)+'" fill="'+c.dot+'" opacity=".55"/>';
  var f=fitT(w.t,{mx:8,cw:.4,fs:78,w:176,h:116,lh:.9,up:true}),tr='rotate(-6 150 170)';
  return '<rect width="300" height="400" fill="'+c.bg+'"/>'+d+'<polygon points="'+star(150,168,138,96,15)+'" fill="'+c.burst+'" stroke="'+c.ink+'" stroke-width="3" stroke-linejoin="round"/>'+TT(f,153.5,(168-f.fs*f.lh*(f.lines.length-1)/2+f.fs*.34+3.5),'middle',FF.bb,400,'normal',c.sh,1.5,tr)+TT(f,150,(168-f.fs*f.lh*(f.lines.length-1)/2+f.fs*.34),'middle',FF.bb,400,'normal',c.ink,1.5,tr)+'<rect y="344" width="300" height="56" fill="'+c.ink+'"/>'+LB('A GRAPHIC NOVEL',24,40,'start',c.ink,.9,7.5,2.6).replace('opacity=".9"','opacity=".9"')+LB(esc((w.by||'').toUpperCase()),24,368,'start',v?'#FFD23F':'#F29102',1,9,2.4)+LB('AMZ UNITED PRESS',24,383,'start','#fff',.5,5,2.4)}
};
function hsh(s){var h=0;for(var i=0;i<s.length;i++)h=(h*31+s.charCodeAt(i))|0;return Math.abs(h)}
function coverSVG(w,id){
  var fn=COV[w.g]||COV.Biography,v=w.v===undefined?0:w.v;
  var grain='<filter id="gr'+id+'" x="0" y="0" width="100%" height="100%"><feTurbulence type="fractalNoise" baseFrequency=".9" numOctaves="1" stitchTiles="stitch"/><feColorMatrix values="0 0 0 0 .1  0 0 0 0 .1  0 0 0 0 .1  0 0 0 .5 0"/></filter><rect width="300" height="400" filter="url(#gr'+id+')" opacity=".13" style="mix-blend-mode:multiply"/>';
  return '<svg viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Concept cover: '+esc(w.t)+'" preserveAspectRatio="xMidYMid slice">'+fn(w,id,v)+grain+'</svg>';
}
function bookHTML(w,id,cls,style){if(w.image)return '<div class="bk portfolio-cover '+(cls||'')+'"'+(style?' style="'+style+'"':'')+'><img src="'+esc(((window.AMZ&&AMZ.base)||'')+w.image)+'" alt="'+esc(w.t)+'" loading="lazy" decoding="async"></div>';return '<div class="bk '+(cls||'')+'"'+(style?' style="'+style+'"':'')+'><span class="bk-pg" aria-hidden="true"></span><div class="bk-face">'+coverSVG(w,id)+'</div></div>'}
