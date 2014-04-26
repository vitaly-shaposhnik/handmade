/** buyButton */
(function() {
	var
		buyButtonClass = '.jsBuyButton',
		buyButton = $(buyButtonClass),
		url;
	// end of vars

	var
		buyButtonClickHandler = function buyButtonClickHandler( event ) {
			event.preventDefault();

			var
				self = $(this),
				url = self.data('url');
			// end of vars

			var
				responseHandler = function( res ) {
					if ( !res.success )  return;

					console.log('Товар добавлен в корзину');
					// действие
				};
			// end of functions

			if ( !url ) return;

			$.post(url, responseHandler);
		};
	// end of functions

	if ( !buyButton.length ) return;

	$('body').on('click', buyButtonClass, buyButtonClickHandler)
})();


/** CartDeleteProduct */
(function() {
	var
		deleteBtnClass = '.jsCartDeleteProduct',
		deleteBtn = $(deleteBtnClass),
		url;
	// end of vars

	var
		deleteBtnClickHandler = function deleteBtnClickHandler( event ) {
			event.preventDefault();

			var
				self = $(this),
				url = self.attr('href'),
				totalQuantity = $('.jsTotalQuantity'),
				totalSum = $('.jsTotalSum');
			// end of vars

			var
				responseHandler = function( res ) {
					if ( !res.success )  return;

					console.log('Товар удален с корзины');
					self.parents('tr').hide('slow', function() {
						if ( totalQuantity.length && res.data.totalQuantity !== undefined ) {
							totalQuantity.text(res.data.totalQuantity);
						}

						if ( totalSum.length && res.data.totalSum !== undefined ) {
							totalSum.text(res.data.totalSum);
						}
					});
				};
			// end of functions

			if ( !url ) return;

			$.post(url, responseHandler);
		};
	// end of functions

	if ( !deleteBtn.length ) return;

	$('body').on('click', deleteBtnClass, deleteBtnClickHandler);
})();

