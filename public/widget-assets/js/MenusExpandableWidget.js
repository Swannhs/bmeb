;((window,document)=>{ // MenusExpandableWidget
document.addEventListener("DOMContentLoaded",function(){
    let isMobile=()=>window.innerWidth<=768;
    var widget=document.querySelector(".menus-expandable-widget");
    let btn=document.querySelector(".menus-expandable-widget .expand-btn");
    let list=document.querySelector(".menus-expandable-widget .menu-parent-unordered-list");
    
    if(!widget || !btn || !list) return;

    if(isMobile()) {
        widget.classList.remove("max-view");
        return;
    }
    
    widget.classList.add("max-view");
    let isExpanded=!1;
    
    let updateItems=()=>{
        if(!isMobile()){
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
            
            // Show/Hide the 'More' button text/icons
            btn.children[0].style.display=isExpanded ? "none" : "inline";
            btn.children[1].style.display=isExpanded ? "inline" : "none";
            btn.style.visibility=hasOverflow||isExpanded?"visible":"hidden";
            btn.style.display="flex"; // Ensure it can be seen
        }
    };
    
    btn.addEventListener("click",(e)=>{
        e.preventDefault();
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
