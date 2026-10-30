/* AMZ United Press — request forms.
   Works on top of normal HTML forms: without JavaScript the browser posts the form to /forms/submit.php.
   With JavaScript we check the fields first and send the form in the background (fetch + POST),
   then show the thank-you message without reloading the page. */
var FORM_MSG={name:'Please enter your full name.',email:'Please enter your email address.',emailBad:'That email doesn’t look right. It should look like name@example.com.',help:'Please choose what you need help with.'};

function validateField(form,name){
  var f=$('[data-f="'+name+'"]',form),i=$('[name="'+name+'"]',f),v=i.value.trim(),msg='';
  if(name==='name'&&!v)msg=FORM_MSG.name;
  if(name==='email'){if(!v)msg=FORM_MSG.email;else if(!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v))msg=FORM_MSG.emailBad}
  if(name==='help'&&!i.value)msg=FORM_MSG.help;
  var e=$('.err',f);if(e)e.textContent=msg;
  f.classList.toggle('invalid',!!msg);
  i.setAttribute('aria-invalid',msg?'true':'false');
  f.classList.toggle('filled',!msg&&!!v);
  return !msg;
}

/* Ad tracking: remember UTM tags / click IDs for the visit and send them with every form. */
var TRACK=(function(){
  var keys=['utm_source','utm_medium','utm_campaign','utm_term','utm_content','gclid','fbclid'],t={},q=new URLSearchParams(location.search);
  try{t=JSON.parse(sessionStorage.getItem('amz_track')||'{}')}catch(e){}
  keys.forEach(function(k){if(q.get(k))t[k]=q.get(k).slice(0,200)});
  if(!t.landing_page)t.landing_page=location.pathname;
  try{sessionStorage.setItem('amz_track',JSON.stringify(t))}catch(e){}
  return t;
})();
function trackLead(form){
  var src=($('[name="source"]',form)||{}).value||'',help=($('[name="help"]',form)||{}).value||'';
  window.dataLayer=window.dataLayer||[];dataLayer.push({event:'lead_submit',form_source:src,service:help,page:location.pathname});
  if(window.gtag)gtag('event','generate_lead',{form_source:src,service:help});
  if(window.fbq)fbq('track','Lead',{content_name:help});
}

function initForm(form){
  Object.keys(TRACK).forEach(function(k){var i=document.createElement('input');i.type='hidden';i.name=k;i.value=TRACK[k];form.appendChild(i)});
  var card=form.closest('.form-card'),banner=$('[data-banner]',form),label=$('[data-label]',form),idle=label.textContent;
  ['name','email','help'].forEach(function(n){
    var i=$('[name="'+n+'"]',form);
    i.addEventListener('blur',function(){if(i.value||i.closest('.field').classList.contains('invalid'))validateField(form,n)});
    i.addEventListener('input',function(){if(i.closest('.field').classList.contains('invalid'))validateField(form,n)});
    i.addEventListener('change',function(){validateField(form,n)});
  });
  var proj=$('[name="project"]',form);proj.addEventListener('input',function(){proj.closest('.field').classList.toggle('filled',!!proj.value.trim())});

  form.addEventListener('submit',function(ev){
    ev.preventDefault();
    if(card.classList.contains('is-submitting'))return;
    banner.classList.remove('show');
    var names=['name','email','help'],ok=names.map(function(n){return validateField(form,n)}),bad=names[ok.indexOf(false)];
    if(bad){$('[name="'+bad+'"]',form).focus();return}
    card.classList.add('is-submitting');label.textContent='Sending…';
    var reset=function(){card.classList.remove('is-submitting');label.textContent=idle};
    var fail=function(msg){reset();if(msg)banner.textContent=msg;banner.classList.add('show');if(banner.scrollIntoView)banner.scrollIntoView({block:'nearest'})};
    fetch(form.action,{method:'POST',body:new FormData(form),headers:{'X-Requested-With':'fetch','Accept':'application/json'},credentials:'same-origin'})
      .then(function(r){return r.json().catch(function(){return {ok:false}})})
      .then(function(d){
        if(d&&d.ok){reset();try{trackLead(form)}catch(e){}card.classList.add('is-done');var s=$('.form-success',card);s.focus();confetti(s)}
        else if(d&&d.errors&&Object.keys(d.errors).length){reset();Object.keys(d.errors).forEach(function(k){var f=$('[data-f="'+k+'"]',form);if(f){$('.err',f).textContent=d.errors[k];f.classList.add('invalid')}});var k0=Object.keys(d.errors)[0],el=$('[name="'+k0+'"]',form);if(el)el.focus()}
        else fail(d&&d.message)
      })
      .catch(function(){fail()});
  });

  var again=$('[data-again]',card);
  if(again)again.addEventListener('click',function(){form.reset();$$('.field',form).forEach(function(f){f.classList.remove('filled','invalid')});card.classList.remove('is-done');$('[name="name"]',form).focus()});
}
$$('form[data-ajax]').forEach(initForm);

/* Landing pages: "Get a quote" buttons scroll to the page form and put the cursor in the first field. */
document.addEventListener('click',function(e){
  var a=e.target.closest('[data-lp-cta]');
  if(a){var t=document.querySelector(a.getAttribute('href'));if(t){e.preventDefault();t.scrollIntoView({behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'auto':'smooth',block:'center'});var f=t.querySelector('input[name="name"]');if(f)setTimeout(function(){f.focus({preventScroll:true})},450)}}
  var c=e.target.closest('[data-lp-call]');
  if(c){window.dataLayer=window.dataLayer||[];dataLayer.push({event:'phone_click',page:location.pathname});if(window.gtag)gtag('event','phone_click')}
});
