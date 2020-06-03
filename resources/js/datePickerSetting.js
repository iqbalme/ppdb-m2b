export const dateOption = {
	i18n: {
		previousMonth : 'Bulan lalu',
		nextMonth     : 'Bulan depan',
		months        : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'],
		weekdays      : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
		weekdaysShort : ['Min','Sen','Sel','Rab','Kam','Jum','Sab']
	},
	minDate: new Date('1950-01-01'),
	maxDate: new Date('2005-12-31'),
	yearRange: [1950,2005]
};

export const dateOption2 = {
	i18n: {
		previousMonth : 'Bulan lalu',
		nextMonth     : 'Bulan depan',
		months        : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'],
		weekdays      : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
		weekdaysShort : ['Min','Sen','Sel','Rab','Kam','Jum','Sab']
	},
	field          : document.getElementById("picker"),
	minDate: new Date('2019-01-01'),
	maxDate: new Date('2030-12-31'),
	// yearRange: [2019,2030],
	// showTime: true,
	// splitTimeView  : false,
    // showSeconds    : true,
    // hours24format  : false
	//timeLabel: null // optional string added to left of time select
};