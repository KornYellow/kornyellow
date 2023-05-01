let forms = document.querySelectorAll('form');
forms.forEach((form) => {
	let submit_button = form.querySelector('button[name="submit"]');
	form.addEventListener('submit', () => {
		submit_button.innerHTML = '<i class="fa-solid fa-spinner fa-spin fa-fw me-2"></i>กำลังดำเนินการ';
		submit_button.classList.add('fake-disable');
	});
});

let nav_buttons = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
nav_buttons.forEach((element) => {
	if (element.pathname === window.location.pathname.split('/').slice(0, 3).join('/')) {
		element.classList.add('active');
	}
});
