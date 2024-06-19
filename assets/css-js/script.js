let maincanvas;
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
function print_doc(id='')
{
    if(!id)
    {
        document.querySelectorAll(`#ballot_all tr:has(#vote_status[class='down_vote'])`).forEach(element=>{
            element.style.display='none';
        })
    }
    else
    {
        document.body.innerHTM=document.querySelector(`#${id}`).innerHTML;
      
    }
    window.print();
    location.reload();
}
document.addEventListener("DOMContentLoaded",(event)=>{
    const date=new Date();
    maincanvas=document.querySelector("#maincanvas");
    const academic_year=date.getFullYear()+'-'+((date.getFullYear()+1)%100);
    const sxc_footer_head=`Designed & Maintained by SXC ERP and Web Team | © 2024 St. Xavier's College. All rights reserved`;
    const sxc_heading='Students Council Election '+academic_year;
    const on_off=document.getElementById('on_off');
    const liveblink=document.getElementById('live-blink');
    const votestatus=document.getElementById('vote_status');
    const footerhead=document.querySelector('.footer-head b');
    const sxcheader=document.querySelector('.sxc-council-header h5 ');
    const ballothead=document.querySelector('#ballot_head b');
    const tab_title=document.querySelector('head title');
    let tab_icon=document.querySelector(`link[rel="shortcut icon"]`);
    const head=document.querySelector('head');
    if(!tab_icon)
    {
        if(head)
        {
           head.innerHTML+=`<link rel='shortcut icon' href='http://localhost/Vote_System/assets/images/other_images/logo2.png' type='image/x-icon' /> `;
        }
    }
    if(tab_title)
        tab_title.innerHTML=sxc_heading;
    if(footerhead)
    footerhead.innerHTML=sxc_footer_head;
	if(sxcheader)
    sxcheader.innerHTML=sxc_heading;
    if(ballothead)
    ballothead.innerHTML=sxc_heading; 
    function init_toast(message = "", id = "my_toast_offline") {
    const toast = document.querySelector(`.toast#${id}`);
    if (message)
      document.querySelector(`#${id} #message`).innerText = message;
    toaster = new bootstrap.Toast(toast);
    toaster.show();
  }
    window.addEventListener("online",(e)=>{
        if(on_off)
        on_off.innerHTML=`<small style='background-color:green;border-radius:50%;width:15px;height:15px;'></small><small>Online</small>`;
        if(liveblink)
        liveblink.getAnimations()[0].play();
        // votestatus.getAnimations()[0].play();
		init_toast('Connection Back Online');
	})
    window.addEventListener("offline",(e)=>{
        if(on_off)
        on_off.innerHTML=`<small style='background-color:red;border-radius:50%;width:15px;height:15px;'></small><small>Offline</small>`;
		if(liveblink)
        liveblink.getAnimations()[0].pause();
		// votestatus.getAnimations()[0].pause();
        init_toast('Connection Offline');
	})
    
})
window.history.replaceState(null,null,window.location.href);