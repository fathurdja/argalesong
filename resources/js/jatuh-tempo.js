// document.addEventListener("DOMContentLoaded", () => {
//     const tahunSelect = document.getElementById("tahun");
//     const bulanSelect = document.getElementById("bulan");
//     const tbody = document.querySelector("tbody");

//     const getData = async () => {
//         try {
//             const response = await fetch(`/jatuh-tempo/data/${tahunSelect.value}/${bulanSelect.value}`);
//             if (!response.ok) throw new Error("Gagal mengambil data");
            
//             const data = await response.json();
//             // console.log(data); 

//             tbody.innerHTML = "";
//             let rows = "";
//             data.forEach(pelanggan => {
//                 rows += `<tr>
//                             <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.idpelanggan}</td>
//                             <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.no_invoice}</td>
//                             <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.kodepiutang}</td>
//                             <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.idpelanggan}</td>
//                             <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgltra}</td>
//                             <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgl_jatuh_tempo}</td>
//                             <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.jumlahTagihan ?? '-'}</td>
//                         </tr>`;
//             });

//             tbody.innerHTML = rows;
//         } catch (error) {
//             console.error("Terjadi kesalahan:", error);
//             tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Gagal mengambil data</td></tr>`;
//         }
//     };

//     tahunSelect.addEventListener("change", getData);
//     bulanSelect.addEventListener("change", getData);

//     getData(); 
// });


document.addEventListener("DOMContentLoaded", () => {
    const tahunSelect = document.getElementById("tahun");
    const bulanSelect = document.getElementById("bulan");
    const tbody = document.querySelector("#tbody");
    const tmobile = document.querySelector("#tmobile");

    const getData = async () => {
        try {
            const response = await fetch(`/jatuh-tempo/data/${tahunSelect.value}/${bulanSelect.value}`);
            if (!response.ok) throw new Error("Gagal mengambil data");
            
            const data = await response.json();
            console.log("Data diterima:", data);

            // Clear existing content
            tbody.innerHTML = "";
            tmobile.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data</td></tr>`;
                tmobile.innerHTML = `<div class="px-4 py-2 text-center text-gray-500">Tidak ada data</div>`;
                return;
            }

            let rows = "";
            let mobileRows = "";
            
            data.forEach((pelanggan, index) => {
                // Tampilkan dalam tabel desktop
                rows += `<tr>
                            <td class="px-6 py-4 text-sm text-gray-500">${index + 1}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.no_invoice}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.kodepiutang}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.idpelanggan}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgltra}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgl_jatuh_tempo}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.jumlahTagihan ?? '-'}</td>
                        </tr>`;
                
                // Tampilkan dalam tampilan mobile
                // sisa membuat detailnya
                mobileRows += `
                <a href="/jatuh-tempo/detail/${pelanggan.no_invoice}" class="text-slate-800 ">
                    <div class="flex justify-between text-lg py-3 px-4">
                        <div class="flex-1 font-bold text-black">${pelanggan.no_invoice}</div>
                        <div class="flex-1 text-right text-black">${pelanggan.jumlahTagihan ?? '-'}</div>
                    </div>
                    <div class="flex justify-between text-sm py-1 px-4">
                        <div class="flex-1 text-black">${pelanggan.tgl_jatuh_tempo}</div>
                        <div class="flex-1 text-right text-black">Pembayaran: ${pelanggan.jumlahTagihan ?? '-'}</div>
                    </div>
                    <div class="flex justify-between text-sm py-1 px-4">
                        <div class="flex-1 font-bold text-black">Saldo Piutang</div>
                        <div class="flex-1 text-right text-black">${pelanggan.jumlahTagihan ?? '-'}</div>
                    </div>
                    
                </a>
              `;

            });

            tbody.innerHTML = rows;
            tmobile.innerHTML = mobileRows;
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Gagal mengambil data</td></tr>`;
            tmobile.innerHTML = `<div class="px-4 py-2 text-center text-gray-500">Gagal mengambil data</div>`;
        }
    };

    tahunSelect.addEventListener("change", getData);
    bulanSelect.addEventListener("change", getData);

    getData(); 
});