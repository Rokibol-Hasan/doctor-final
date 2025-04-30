document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('doctorDropdown');
    const menu = document.getElementById('doctorDropdownMenu');
    let loaded = false;

    dropdown.addEventListener('mouseenter', function () {
        if (loaded) return;

        fetch('/get-locations')
            .then(response => response.json())
            .then(data => {
                menu.innerHTML = ''; // Clear loading text
                data.forEach(location => {
                    const li = document.createElement('li');
                    li.innerHTML = `<a class="dropdown-item" href="/doctors-${location.slug}">${location.name}</a>`;
                    menu.appendChild(li);
                });
                loaded = true;
            })
            .catch(error => {
                menu.innerHTML = '<li><span class="dropdown-item-text text-danger">Failed to load locations</span></li>';
            });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const dropdown = document.querySelector("#doctorDropdownWrapper");

    dropdown.addEventListener("mouseenter", function () {
        const dropdownToggle = dropdown.querySelector(".dropdown-toggle");
        const dropdownMenu = dropdown.querySelector(".dropdown-menu");

        dropdown.classList.add("show");
        dropdownToggle.setAttribute("aria-expanded", "true");
        dropdownMenu.classList.add("show");
    });

    dropdown.addEventListener("mouseleave", function () {
        const dropdownToggle = dropdown.querySelector(".dropdown-toggle");
        const dropdownMenu = dropdown.querySelector(".dropdown-menu");

        dropdown.classList.remove("show");
        dropdownToggle.setAttribute("aria-expanded", "false");
        dropdownMenu.classList.remove("show");
    });
});




(function () {

	"use strict";

	//===== Prealoder

	window.onload = function () {
		window.setTimeout(fadeout, 200);
	}


    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }


    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        if (window.pageYOffset > sticky) {
            header_navbar.classList.add("sticky");
        } else {
            header_navbar.classList.remove("sticky");
        }

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };

     //===== mobile-menu-btn
	let navbarToggler = document.querySelector(".mobile-menu-btn");
	navbarToggler.addEventListener('click', function () {
		navbarToggler.classList.toggle("active");
	});
    
    // WOW active
    new WOW().init();
    
})();

