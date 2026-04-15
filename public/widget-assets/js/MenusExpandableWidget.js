;((window,document)=>{ // MenusExpandableWidget
let widget=document.querySelector(".menus-expandable-widget");

if(widget && window.innerWidth<=768){
    widget.classList.remove("max-view");
}

document.addEventListener("DOMContentLoaded",function(){
    let isMobile=()=>window.innerWidth<=768;
    var widget=document.querySelector(".menus-expandable-widget");
    let btn=document.querySelector(".menus-expandable-widget .expand-btn");
    let list=document.querySelector(".menus-expandable-widget .menu-parent-unordered-list");
    let forceExtraItems=list ? [...list.querySelectorAll(".force-extra")] : [];
    
    if(!widget || !btn || !list) return;
    
    widget.classList.add("max-view");
    let isExpanded=!1;
    let isMobileExpanded=!1;

    let updateButtonState=(expanded)=>{
        btn.children[0].style.display=expanded ? "none" : "inline-flex";
        btn.children[1].style.display=expanded ? "inline-flex" : "none";
        btn.setAttribute("aria-expanded", expanded ? "true" : "false");
    };

    let updateMobileItems=()=>{
        let hasForcedExtras=forceExtraItems.length > 0;

        forceExtraItems.forEach(item=>{
            item.style.display=isMobileExpanded ? "flex" : "none";
        });

        btn.style.display=hasForcedExtras ? "inline-flex" : "none";
        btn.style.visibility=hasForcedExtras ? "visible" : "hidden";
        updateButtonState(isMobileExpanded);
        widget.classList.toggle("mobile-expanded", isMobileExpanded);
        widget.classList.remove("max-view");
    };
    
    let updateItems=()=>{
        if(isMobile()){
            updateMobileItems();
            return;
        }

        widget.classList.add("max-view");
        let hasOverflow=!1;

        [...list.children].forEach(item=>{
            // Force .force-extra items into overflow
            // OR any items that wrap
            let shouldHideByWrap = item.offsetTop > item.parentElement.offsetTop;
            let isForceExtra = item.classList.contains('force-extra');
            
            if(shouldHideByWrap || isForceExtra || isExpanded){
                hasOverflow = true;
                if(!isExpanded && (shouldHideByWrap || isForceExtra)) {
                    item.style.display="none";
                } else {
                    item.style.display="flex";
                }
            } else {
                item.style.display="flex";
            }
        });
        
        updateButtonState(isExpanded);
        btn.style.visibility=hasOverflow||isExpanded?"visible":"hidden";
        btn.style.display="inline-flex";
        widget.classList.remove("mobile-expanded");
    };
    
    btn.addEventListener("click",(e)=>{
        e.preventDefault();

        if(isMobile()){
            isMobileExpanded=!isMobileExpanded;
            updateItems();
            return;
        }

        isExpanded=!isExpanded;
        updateItems();
    });
    
    window.addEventListener("resize",()=>{
        updateItems();
    });
    
    // Initial run
    setTimeout(updateItems, 100);
});
})(window,document);
