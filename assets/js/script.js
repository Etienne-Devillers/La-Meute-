window.addEventListener('scroll', () => {
    navBarAttached()
})


document.querySelector('.burgerMenu').addEventListener('click', () => {
    console.log('bonjour')
    document.querySelector('.sideNavBarContainer').classList.add('active');
    document.querySelector('.sideNavBar').classList.add('sideNavBarActive');
})

document.querySelector('.sideNavBarContainer').addEventListener('click', () => {
    document.querySelector('.sideNavBar').classList.remove('sideNavBarActive');
    
    document.querySelector('.sideNavBarContainer').classList.remove('active');

})


document.querySelector('.sideNavBarContainer').addEventListener('click', () => {
    document.querySelector('.sideNavBarContainer').classList.remove('active');
})