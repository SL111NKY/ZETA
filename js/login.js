const wrapper = document.querySelector(".wrapper");
const registerlink = document.querySelector("#registerlink");
const loginlink = document.querySelector("#loginlink");

//LOGIN / REGI ANIMATIONS
loginlink.addEventListener('click', ()=> {
	wrapper.classList.add('active');
});

registerlink.addEventListener('click', ()=> {
	wrapper.classList.remove('active');
});

