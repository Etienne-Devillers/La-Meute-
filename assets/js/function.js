function navBarAttached()  {
    if (document.documentElement.scrollTop > 80) {
        document.querySelector('.navBar').classList.add('fixed')
        document.querySelector('.logoNavBar').classList.add('logoNavBarFixed')
    } else {
        document.querySelector('.navBar').classList.remove('fixed')
        document.querySelector('.logoNavBar').classList.remove('logoNavBarFixed')
    }
}