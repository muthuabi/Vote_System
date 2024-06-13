const maincanvas=document.getElementById("maincanvas");
window.addEventListener("resize",(e)=>{
    if(maincanvas)
    {
       if(window.innerWidth>=768)
       {
           //maincanvas.style.transform='translateX(0)';
           maincanvas.style.visibility='visible';
           document.querySelectorAll('.modal-backdrop').forEach(element=>{
            element.style.display='none';
           })   
        //    maincanvas.setAttribute('visibility','visible');
       }
       else
       { 
           maincanvas.style.visibility='hidden';
       }
    }
       
})
document.addEventListener("DOMContentLoaded",(event)=>{
    const date=new Date();
    const academic_year=date.getFullYear()+'-'+((date.getFullYear()+1)%100);
   
    const on_off=document.getElementById('on_off');
    const liveblink=document.getElementById('live-blink');
    const votestatus=document.getElementById('vote_status');
    const footerhead=document.querySelector('.footer-head b');
    footerhead.innerHTML="Designed & Maintained by SXC ERP and Web Team | © 2024 St. Xavier's College. All rights reserved";
	document.querySelector('.sxc-council-header h5 ').innerHTML='Students Council Election '+academic_year;
    document.querySelector('#ballot-head b').innerHTML='Students Council Election '+academic_year; 
    function init_toast(message = "", id = "my_toast_offline") {
    const toast = document.querySelector(`.toast#${id}`);
    if (message)
      document.querySelector(`#${id} #message`).innerText = message;
    toaster = new bootstrap.Toast(toast);
    toaster.show();
  }
    window.addEventListener("online",(e)=>{
        on_off.innerHTML=`<small style='background-color:green;border-radius:50%;width:15px;height:15px;'></small><small>Online</small>`;
        liveblink.getAnimations()[0].play();
        // votestatus.getAnimations()[0].play();
		init_toast('You are Back Online');
	})
    window.addEventListener("offline",(e)=>{
        on_off.innerHTML=`<small style='background-color:red;border-radius:50%;width:15px;height:15px;'></small><small>Offline</small>`;
		liveblink.getAnimations()[0].pause();
		// votestatus.getAnimations()[0].pause();
        init_toast('You are Offline');
	})
    
})
window.history.replaceState(null,null,window.location.href);