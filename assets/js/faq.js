
let collapsibleList = document.querySelectorAll('.collapsibleButton');

for (let i = 0; i < collapsibleList.length; i++) {
    
    collapsibleList[i].addEventListener('click', function(){
        this.classList.toggle('questionActive');
        let content = this.nextElementSibling.nextElementSibling;
        if (content.style.display === "block") {
            content.classList.toggle('inactiveAnswer');
            content.style.maxHeight = null;
            this.nextElementSibling.classList.toggle('switchButton');
        } else {
            content.classList.toggle('activeAnswer')
        content.style.maxHeight = content.scrollHeight + "px";
        this.nextElementSibling.classList.toggle('switchButton');
        }
    })
}

