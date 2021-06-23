const extension = {
'svg'		: '001-file.svg',
'js'		: '002-file-1.svg',
'png'		: '003-file-2.svg',
'jpg'		: '004-file-3.svg',
'doc'		: '005-file-4.svg',
'docx'	: '005-file-4.svg',
0				: '006-file-5.svg',
'xml'		: '007-file-6.svg',
'pdf'		: '008-file-7.svg',
'zip'		: '009-file-8.svg',
'mp3'		: '010-file-9.svg',
'mp4'		: '011-file-10.svg',
'eps'		: '012-file-11.svg',
'avi'		: '013-file-12.svg',
'ai'		: '014-file-13.svg',
'fla'		: '015-file-14.svg',
'psd'		: '016-file-15.svg',
'bin'		: '017-file-16.svg',
'exe'		: '018-file-17.svg',
'ico'		: '019-file-18.svg',
'mkv'		: '020-file-19.svg',
'wmv'		: '021-file-20.svg',
'mov'		: '022-file-21.svg',
'ppt'		: '023-file-22.svg',
'pptx'	: '023-file-22.svg',
'iso'		: '024-file-23.svg',
'gif'		: '025-file-24.svg',
'jar'		: '026-file-25.svg',
'vcf'		: '027-file-26.svg',
'obj'		: '028-file-27.svg',
'html'	: '029-file-28.svg',
'dll'		: '030-file-29.svg',
'asp'		: '031-file-30.svg',
'dwg'		: '032-file-31.svg',
'eml'		: '033-file-32.svg',
'txt'		: '034-file-33.svg',
'3ds'		: '035-file-34.svg',
'ini'		: '036-file-35.svg',
'otf'		: '037-file-36.svg',
'ttf'		: '038-file-37.svg',
'pkg'		: '039-file-38.svg',
'com'		: '040-file-39.svg',
'nfo'		: '041-file-40.svg',
'wav'		: '042-file-41.svg',
'rar'		: '043-file-42.svg',
1				: '044-file-43.svg',
'rip'		: '045-file-44.svg',
'none'	: '046-file-45.svg',
'xls'		: '047-file-46.svg',
'xlsx'	: '047-file-46.svg',
'xlsm'	: '047-file-46.svg',
'csv'		: '048-file-47.svg',
'dbf'		: '049-file-48.svg',
'css'		: '050-file-49.svg',
};
var scripts = document.getElementsByTagName('script'), src = scripts[scripts.length-1].src;
src = src.replace(/[^\/]*$/, "");
img = (file) => {
	let ex = file.split('.').pop();
	return `<img src="${src}/${(extension[ex] === undefined ? extension['none'] : extension[ex])}" height="30"/>`;
}





































