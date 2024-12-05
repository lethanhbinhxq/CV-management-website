function copyToClipboard() {
    const urlInput = document.getElementById('shareable-url');

    // Select the text and copy it to the clipboard
    urlInput.select();
    urlInput.setSelectionRange(0, 99999); // For mobile compatibility
    navigator.clipboard.writeText(urlInput.value)
        .then(() => {
            // Show the Bootstrap toast
            const toastElement = document.getElementById('clipboardToast');
            const toast = new bootstrap.Toast(toastElement);
            toast.show();
        })
        .catch(() => {
            console.error('Failed to copy the link.');
        });
}

// Optional: Generate the shareable CV URL dynamically
function generateCvUrl(cvId) {
    const shareableUrl = `${window.location.origin}/CV-management-website/${cvId}`;
    const urlInput = document.getElementById('shareable-url');
    urlInput.value = shareableUrl;
    urlInput.parentElement.classList.remove('d-none');
}
