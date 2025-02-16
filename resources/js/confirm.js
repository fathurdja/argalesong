function konfirmasiDelete(event, form) {
    event.preventDefault(); // Mencegah submit otomatis

    // Hapus modal sebelumnya jika ada
    const existingModal = document.getElementById("confirmModal");
    if (existingModal) {
        existingModal.remove();
    }

    const modalHTML = `
        <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 px-6">
            <div class="bg-white p-6 rounded-md shadow-lg text-center">
                <p class="text-lg font-semibold text-gray-800">
                    Apakah Anda yakin ingin menghapus pelanggan <strong>{{ $pelanggan->company->name }}</strong>?
                </p>
                <div class="mt-4 flex justify-center space-x-4">
                    <button id="confirmYes" class="px-4 py-2 bg-red-600 text-white rounded">Ya</button>
                    <button id="confirmNo" class="px-4 py-2 bg-gray-300 text-black rounded">Batal</button>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML("beforeend", modalHTML);

    document.getElementById("confirmYes").addEventListener("click", function () {
        form.submit(); // Submit form jika user memilih "Ya"
    });

    document.getElementById("confirmNo").addEventListener("click", function () {
        document.getElementById("confirmModal").remove(); // Hapus modal jika "Batal"
    });

    return false; // Mencegah submit form langsung
}