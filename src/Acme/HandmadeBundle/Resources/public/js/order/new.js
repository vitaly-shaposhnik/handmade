(function() {
	var
		phoneNumberField = $("#handmade_order_phoneNumber");

	if ( phoneNumberField.length ) {
		phoneNumberField.mask("+38 (099) 999-9999");
	}
})();