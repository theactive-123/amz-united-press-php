/* AMZ United Press — landing-page widgets: service picker tabs and the before/after editing sample. */
(function(){
  document.querySelectorAll('[data-lp-pick]').forEach(function(box){
    var tabs=[].slice.call(box.querySelectorAll('[role=tab]'));
    function pick(t,focus){tabs.forEach(function(x){var on=x===t;x.setAttribute('aria-selected',on);x.tabIndex=on?0:-1;document.getElementById(x.getAttribute('aria-controls')).hidden=!on});if(focus)t.focus()}
    tabs.forEach(function(t,i){
      t.addEventListener('click',function(){pick(t)});
      t.addEventListener('keydown',function(e){var k=e.key,n=k==='ArrowDown'||k==='ArrowRight'?1:k==='ArrowUp'||k==='ArrowLeft'?-1:0;if(n){e.preventDefault();pick(tabs[(i+n+tabs.length)%tabs.length],true)}});
    });
  });
  document.querySelectorAll('[data-lp-ba]').forEach(function(box){
    box.querySelectorAll('[data-v]').forEach(function(b){b.addEventListener('click',function(){box.setAttribute('data-v',b.getAttribute('data-v'));box.querySelectorAll('button[data-v]').forEach(function(x){x.setAttribute('aria-pressed',x===b)})})});
  });
})();
