export function tanggal(value="") {
    let regex = new RegExp(/(^19[5-9]\d|^200[0-5])-(0[1-9]|1[012])\-([012][1-9]|3[01])$/); //1950 - 2005
    return regex.test(value)
}

export function tanggal_kelulusan(value="") {
    let regex = new RegExp(/(^201[0-9]|^2020)-(0[1-9]|1[012])\-([012][1-9]|3[01])$/); //2010 - 2020
    return regex.test(value)
}

export function maxValueAnakKe(saudara, value){
	return saudara + 1
}