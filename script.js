// Mendapatkan semua link menu di sidebar
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// Loop untuk menambahkan event listener ke setiap item menu
allSideMenu.forEach(item => {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		// Menghapus kelas 'active' dari semua item menu
		allSideMenu.forEach(i => {
			i.parentElement.classList.remove('active');
		});
		// Menambahkan kelas 'active' ke item menu yang diklik
		li.classList.add('active');

		// Menyimpan halaman yang diklik ke local storage untuk mempertahankan status aktif
		localStorage.setItem('activePage', this.getAttribute('href'));
	});
});

// Memuat status halaman aktif dari local storage saat halaman dimuat
window.addEventListener('load', () => {
	const activePage = localStorage.getItem('activePage');
	if (activePage) {
		allSideMenu.forEach(item => {
			if (item.getAttribute('href') === activePage) {
				item.parentElement.classList.add('active');
			} else {
				item.parentElement.classList.remove('active');
			}
		});
	}
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
});


// FUNGSI UNTUK TOMBOL PENCARIAN
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

// Menambahkan event listener ke tombol pencarian untuk layar kecil
searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();  // Mencegah pengiriman form default
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x'); // Ganti ikon menjadi 'x'
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search'); // Kembalikan ikon menjadi pencarian
		}
	}
});

// SWITCH MODE (Mode Gelap dan Terang)
const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark'); // Tambahkan kelas 'dark' untuk mode gelap
	} else {
		document.body.classList.remove('dark'); // Hapus kelas 'dark' untuk mode terang
	}
});
