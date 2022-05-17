
let collapsibleList = document.querySelectorAll('.collapsibleButton');

for (let i = 0; i < collapsibleList.length; i++) {
    
    collapsibleList[i].addEventListener('click', function(){
        this.classList.toggle('questionActive');
        let content = this.nextElementSibling.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
            content.style.maxHeight = null;
            this.nextElementSibling.classList.toggle('switchButton');
        } else {
        content.style.display = "block";
        content.style.maxHeight = content.scrollHeight + "px";
        this.nextElementSibling.classList.toggle('switchButton');
        }
    })
}

