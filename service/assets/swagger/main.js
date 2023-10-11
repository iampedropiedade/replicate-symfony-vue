import './styles/swagger.scss';

import {
    Toaster,
    ToasterPosition,
    ToasterType,
} from "bs-toaster";

let models = document.querySelector('.wrapper .models')
models.querySelector('.models-control').click()

let authButtonsOpen = document.querySelectorAll('[href="#unlocked"]')
authButtonsOpen.forEach(button => {
    let icon = document.createElement('i');
    icon.classList.add('fa-solid', 'fa-lock-open')
    button.parentElement.replaceWith(icon)
});

let authButtons = document.querySelectorAll('.locked svg')
authButtons.forEach(button => {
    let icon = document.createElement('i');
    icon.classList.add('fa-solid', 'fa-lock')
    button.replaceWith(icon)
});

let copyButtons = document.querySelectorAll('.copy-to-clipboard')
copyButtons.forEach(button => {
    button.innerHTML = '<i class="fa-solid fa-copy"></i>'
    button.addEventListener('click', () => {
        let toast = new Toaster({
            position: ToasterPosition.TOP_END,
            type: ToasterType.SUCCESS,
            delay: 5000,
            animation: true,
        });
        let pathElement = button.parentElement.querySelector('[data-path]');
        navigator.clipboard.writeText(pathElement.dataset.path);
        toast.create(
            'Success',
            'The endpoint <strong>' + pathElement.dataset.path + '</strong> was successfully copied to clipboard.'
        );
    });
});

document.addEventListener('click', (event) => {
    if(event.target.parentElement.className !== 'auth-btn-wrapper') {
        return
    }
    let buttonWrapper = event.target;
    let authButtons = document.querySelectorAll('.authorization__btn i, .btn.authorize i')

    if(buttonWrapper.innerHTML === 'Logout') {
        authButtons.forEach(icon => {
            icon.classList.remove('fa-lock')
            icon.classList.add('fa-lock-open')
        });
    }
    else {
        authButtons.forEach(icon => {
            icon.classList.remove('fa-lock-open')
            icon.classList.add('fa-lock')
        });
    }
}, true);

