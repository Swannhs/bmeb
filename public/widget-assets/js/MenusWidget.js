;((window, document) => {
document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("menu-toggle");
    const menuList = document.querySelector(".menu-parent-unordered-list");
    const menuItems = Array.from(document.querySelectorAll(".menu-parent-list"));
    const palette = ["#FF4500", "#FF1493", "#00BFFF", "#32CD32", "#1E90FF", "#FF69B4", "#00CED1", "#8A2BE2", "#FFA500", "#FF6347", "#4682B4"];

    if (!toggleButton || !menuList) {
        return;
    }

    const isMobile = () => window.innerWidth <= 768;
    const colorFor = (index) => palette[index % palette.length];
    const directChildMatch = (parent, selector) => Array.from(parent.children).find((child) => child.matches(selector)) || null;

    const closeDropdown = (item) => {
        const trigger = directChildMatch(item, "a");
        const dropdown = directChildMatch(item, ".mega-menu-dropdown");

        if (!trigger || !dropdown) {
            return;
        }

        dropdown.classList.remove("show");
        dropdown.style.display = "none";
        item.classList.remove("is-open");

        if (isMobile()) {
            trigger.style.backgroundColor = "";
            trigger.style.color = "";
        }
    };

    const closeAllDropdowns = () => {
        menuItems.forEach(closeDropdown);
    };

    const syncMenuState = (open) => {
        menuList.classList.toggle("show-menu", open);
        toggleButton.classList.toggle("is-open", open);
        toggleButton.setAttribute("aria-expanded", open ? "true" : "false");

        if (!open) {
            closeAllDropdowns();
        }
    };

    // Redundant toggle listener removed to avoid conflict with MenusExpandableWidget.js
    /*
    toggleButton.addEventListener('click', function () {
        menuList.classList.toggle('show-menu');
    });
    */
    toggleButton.addEventListener("click", () => {
        if (!isMobile()) {
            return;
        }

        syncMenuState(!menuList.classList.contains("show-menu"));
    });

    menuItems.forEach((item, index) => {
        const trigger = directChildMatch(item, "a");
        const dropdown = directChildMatch(item, ".mega-menu-dropdown");
        const color = colorFor(index);

        if (!trigger) {
            return;
        }

        trigger.style.color = color;

        if (dropdown) {
            dropdown.style.borderTop = "6px solid " + color;

            trigger.addEventListener("click", (event) => {
                if (!isMobile()) {
                    return;
                }

                event.preventDefault();

                if (!menuList.classList.contains("show-menu")) {
                    syncMenuState(true);
                }

                const opening = !dropdown.classList.contains("show");
                closeAllDropdowns();

                if (opening) {
                    dropdown.style.display = "block";
                    dropdown.classList.add("show");
                    item.classList.add("is-open");
                    trigger.style.backgroundColor = "#f3fbf5";
                    trigger.style.color = "var(--color-primary-dark)";
                }
            });
        }

        trigger.addEventListener("mouseenter", () => {
            if (isMobile()) {
                return;
            }

            trigger.style.backgroundColor = color;
            trigger.style.color = "#fff";
        });

        trigger.addEventListener("mouseleave", () => {
            if (isMobile()) {
                return;
            }

            if (!dropdown || !dropdown.classList.contains("show")) {
                trigger.style.backgroundColor = "";
                trigger.style.color = color;
            }
        });
    });

    window.addEventListener("resize", () => {
        if (!isMobile()) {
            syncMenuState(false);
        }
    });
});
})(window, document);
