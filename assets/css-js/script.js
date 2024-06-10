document.addEventListener("DOMContentLoaded",(event)=>{
    const maincanvas=document.getElementById("maincanvas");
    const on_off=document.getElementById('on_off');
	function init_toast(message = "", id = "my_toast_offline") {
    const toast = document.querySelector(`.toast#${id}`);
    if (message)
      document.querySelector(`#${id} #message`).innerText = message;
    toaster = new bootstrap.Toast(toast);
    toaster.show();
  }
    window.addEventListener("online",(e)=>{
        on_off.innerHTML=`<small style='background-color:green;border-radius:50%;width:10px;height:10px;'></small><small>Online</small>`;
		init_toast('You are Back Online');
	})
    window.addEventListener("offline",(e)=>{
        on_off.innerHTML=`<small style='background-color:red;border-radius:50%;width:10px;height:10px;'></small><small>Offline</small>`;
		init_toast('You are Offline');
	})
    window.addEventListener("resize",(e)=>{
        if(maincanvas)
        {
        if(window.innerWidth>=768)
        {
            //maincanvas.style.transform='translateX(0)';
            maincanvas.style.visibility='visible';
        }
        else
        { 
            maincanvas.style.visibility='hidden';
        }
    }
        
    })
})
window.history.replaceState(null,null,window.location.href);