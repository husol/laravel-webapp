(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "../jquery.validate"], factory );
	} else if (typeof module === "object" && module.exports) {
		module.exports = factory( require( "jquery" ) );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: VI (Vietnamese; Tiếng Việt)
 */
$.extend( $.validator.messages, {
	required: "Đây là thông tin bắt buộc.",
	remote: "Hãy sửa cho đúng.",
	email: "Hãy nhập đúng email.",
	url: "Hãy nhập đúng URL.",
	date: "Hãy nhập đúng ngày tháng.",
	dateISO: "Hãy nhập đúng ngày (ISO).",
	number: "Hãy nhập kiểu số.",
	digits: "Hãy nhập kiểu chữ số.",
	creditcard: "Hãy nhập đúng số thẻ tín dụng.",
	equalTo: "Hãy nhập giống như trên.",
	extension: "Phần mở rộng không đúng.",
	maxlength: $.validator.format( "Hãy nhập từ {0} kí tự trở xuống." ),
	minlength: $.validator.format( "Hãy nhập từ {0} kí tự trở lên." ),
	rangelength: $.validator.format( "Hãy nhập từ {0} đến {1} kí tự." ),
	range: $.validator.format( "Hãy nhập từ {0} đến {1}." ),
	max: $.validator.format( "Hãy nhập từ {0} trở xuống." ),
	min: $.validator.format( "Hãy nhập từ {1} trở lên." )
} );

}));