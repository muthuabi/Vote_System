function modal_show(id,message='')
{
    document.addEventListener("DOMContentLoaded",()=>{
        const bs_modal=document.querySelector(id);
        if(message)
            document.querySelector(id+" "+"#message").innerHTML=message;
        modal=new bootstrap.Modal(bs_modal);
        modal.show();
    })
}
function modal_hide(id)
{
    document.addEventListener("DOMContentLoaded",()=>{
        const bs_modal=document.querySelector(id);
        modal=new bootstrap.Modal(bs_modal);
        modal.hide();
    })
}