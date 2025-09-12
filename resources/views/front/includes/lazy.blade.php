<script>

    function lazyLoadImage(t,e=.1){let r=document.querySelectorAll(t),o=new IntersectionObserver(function t(e,r){e.forEach(t=>{if(t.isIntersecting){let e=t.target,o=e.getAttribute("data-src");e.setAttribute("src",o),e.removeAttribute("data-src"),r.unobserve(e)}})},{root:null,rootMargin:"0px",threshold:e});r.forEach(t=>{o.observe(t)})}
</script>
