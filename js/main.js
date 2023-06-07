// grab elements

const selectElement = selector => {
    const element = document.querySelector(selector);
    if(element) return element;
    throw new Error(`something went wrong, make sure that this selector ${selector} exists `);
}

// nav styles on scroll

const scrollHeader = () => {
    const headerElement = selectElement("#header");
    if(this.scrollY >= 15) {
        headerElement.classList.add('activated');
    }
    else {
        headerElement.classList.remove('activated');
    }
}
window.addEventListener('scroll', scrollHeader);

// open and close the menu and search

const menuToggleIcon = selectElement('#menu-toggle-icon');

const toggleMenu = () => {
    const MobileMenu = selectElement("#menu");
    MobileMenu.classList.toggle("activated");
    menuToggleIcon.classList.toggle("activated");
}
menuToggleIcon.addEventListener("click", toggleMenu);

/** theme switching */

const bodyElement = document.body;
const themeToggleBtn = selectElement("#theme-toggle-btn");
const currentTheme = localStorage.getItem("currentTheme");
if(currentTheme) {
    bodyElement.classList.add("light-theme");
}
themeToggleBtn.addEventListener("click", () => {
    bodyElement.classList.toggle("light-theme");
    if(bodyElement.classList.contains("light-theme"))
        localStorage.setItem('currentTheme', 'themeActive');
    else
        localStorage.removeItem('currentTheme')
})

/* search */

const searchbtn = selectElement('#search-icon');
const searchFormContainer = selectElement('.search-form-container');
const closeSearchbtn = selectElement('.form-close-btn');
searchbtn.addEventListener('click', e => {
    searchFormContainer.classList.add('activated');
})
closeSearchbtn.addEventListener('click', e => {
    searchFormContainer.classList.toggle('activated');
})

//swiper

const swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetweem: 20,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
    },
    pagination: {
        el: '.swiper-pagination'
    }
})