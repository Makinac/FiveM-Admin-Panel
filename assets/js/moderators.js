document.querySelector('.btn-new-user').addEventListener('click', () => {
    document.getElementById('new-user-modal').classList.remove('hidden');
    document.getElementById('new-user-modal').classList.add('visible');
});

document.getElementById('close-new-user-modal').addEventListener('click', () => {
    document.getElementById('new-user-modal').classList.remove('visible');
    document.getElementById('new-user-modal').classList.add('hidden');
});
