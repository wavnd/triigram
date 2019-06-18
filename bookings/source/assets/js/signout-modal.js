/**
 * Get the DOM Elements
 */
const modal = document.querySelector('#my-modal');
const modalBtns = document.querySelectorAll('#modal-btn');
const closeBtn = document.querySelector('.close');
const editDelete = document.getElementById('edt-dlt');
/**
 * Events listeners for the modal functionality
 */
modalBtns.forEach(modalBtn => {
    modalBtn.addEventListener('click', openModal);
});

closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', outsideClick);
editDelete.addEventListener('click', openModal);

/**
 * Open the modal on signout
 */
function openModal() {
    modal.style.display = 'block';
}

/**
 * Close the modal if the close option is clicked
 */
function closeModal() {
    modal.style.display = 'none';
}

/**
 * Close If a user clicks outside of the modal
 */
function outsideClick(e) {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
}
