@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formPayment = document.getElementById('form-payment');
        const totalRpInput = document.getElementById('totalRp');
        const acceptedInput = document.getElementById('accepted');
        const moneyChangesInput = document.getElementById('money_changes');
        const discountInputs = document.querySelectorAll('.disc');

        // Function to calculate and update the change
        const calculateChange = () => {
            const total = parseFloat(totalRpInput.value);
            const accepted = parseFloat(acceptedInput.value);
            const change = accepted - total;
            moneyChangesInput.value = change > 0 ? change : 0;
        };

        // Calculate change on accepted input change
        acceptedInput.addEventListener('input', calculateChange);

        // Update discount and recalculate total price
        discountInputs.forEach(input => {
            input.addEventListener('input', function () {
                const discountValue = parseFloat(this.value);
                const itemId = this.dataset.id;

                // Send AJAX request to update discount
                fetch(`{{ route('pembayaran-cash.updateDiscount') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: itemId,
                        discount: discountValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        totalRpInput.value = data.newTotalPrice;
                        calculateChange();
                    } else {
                        alert('Failed to update discount.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Handle form submission with AJAX
        document.querySelector('.btn-submit').addEventListener('click', function () {
            const formData = new FormData(formPayment);

            fetch(formPayment.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Transaction saved successfully!');
                    // Optionally, redirect or update the UI here
                } else {
                    alert('Failed to save transaction.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush
