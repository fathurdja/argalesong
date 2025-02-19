function fetchCustomers() {
	const companyId = document.getElementById('idcompany').value; // Ambil ID perusahaan yang dipilih
	const pelangganList = document.getElementById('pelangganList'); // Ambil elemen data list pelanggan

	// Kosongkan data list pelanggan
	pelangganList.innerHTML = '';

	// Pastikan companyId tidak kosong
	if (companyId) {
		fetch(`/get-customers/${companyId}`) // Panggil endpoint untuk mengambil pelanggan
			.then(response => response.json())
			.then(data => {
				// Tambahkan opsi pelanggan ke dalam data list
				data.forEach(customer => {
					const option = document.createElement('option');
					option.value = customer.id_Pelanggan; // Tampilkan nama pelanggan di input
					option.setAttribute('data-id', customer.id_Pelanggan); // Simpan ID pelanggan
					pelangganList.appendChild(option);
				});

				// Simpan ID pelanggan terpilih di hidden input jika diperlukan
				document.getElementById('id_Pelanggan_actual').value = '';
			})
			.catch(error => console.error('Error fetching customers:', error));
	}
}
document.getElementById('id_Pelanggan').addEventListener('input', function() {
	const pelangganList = document.getElementById('pelangganList');
	const options = pelangganList.options;
	const inputValue = this.value; // Nilai input pengguna

	for (let i = 0; i < options.length; i++) {
		if (options[i].value === inputValue) {
			// Jika input sesuai dengan nama pelanggan, set hidden input dengan ID pelanggan
			document.getElementById('id_Pelanggan_actual').value = options[i].getAttribute('data-id');
			break;
		}
	}
});



// document.querySelector('button')[0].addEventListener('click', ()=> {
// 	const tabelData = document.getElementById('tabel-data');
// 	tabelData.classList.remove('hidden');
// });