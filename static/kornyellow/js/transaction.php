<?php

namespace kornyellow\static\kornyellow\js;

use libraries\kornyellow\instances\methods\transaction\KYTransaction;

?>

<script>
	let autocomplete_transaction = (event) => {
		const jsonData = '<?= KYTransaction::getAllNameJSON() ?>';
		const data = JSON.parse(jsonData);

		let input = event.target;
		let value = input.value.toLowerCase();

		let resultsContainer = document.getElementById('transaction_name_result');
		resultsContainer.innerHTML = '';

		let uniqueMatches = [...new Set(data.filter(function (transaction) {
			return transaction.toLowerCase().indexOf(value) !== -1 && transaction.toLowerCase() !== value;
		}))];

		uniqueMatches.sort(function (a, b) {
			return b.localeCompare(a);
		});

		if (value === '') {
			let counts = {};
			data.forEach(function (transaction) {
				counts[transaction] = (counts[transaction] || 0) + 1;
			});
			let sortedByCount = Object.keys(counts).sort(function (a, b) {
				return counts[b] - counts[a];
			});
			uniqueMatches = sortedByCount.slice(0, 10);
		}

		uniqueMatches.forEach(function (match) {
			let option = document.createElement('option');
			option.value = match;
			resultsContainer.appendChild(option);
		});
	}
	let nameInput = document.getElementById("name");
	nameInput.onfocus = autocomplete_transaction;
	nameInput.onkeyup = autocomplete_transaction;
</script>