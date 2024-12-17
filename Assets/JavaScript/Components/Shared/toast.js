export const showToast = (message, color) => {
    const toastElement = document.querySelector('.toast')
    const toast = new bootstrap.Toast(toastElement, { delay: 5000 })

    toastElement.classList.remove('bg-success', 'bg-danger')
    toastElement.classList.add(color)

    toastElement.querySelector('.toast-body').innerHTML = message
    toast.show()
}