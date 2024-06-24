<script>
  function saveNewAddress() {
      axios.post('{{ route('addresses.store') }}', {
          __token: '{{ csrf_token() }}',
          'governorate': $('#newGovernorate').val(),
          'city': $('#newCity').val(),
          'street': $('#newStreet').val(),
          'house_number': $('#newHouseNumber').val(),
          'postal_code': $('#newPostalCode').val(),
          'famous_place_nearby': $('#newFamousPlaceNearby').val(),
      }).then(function(response) {
          if (response.data.status === 'error') {
              let errors = response.data.errors;
              let lists = '';
              for (const [key, value] of Object.entries(errors)) {
                  lists += ` <li class="text-danger">${value}</li>`; 
              }
              $('#store-errors').html(`<ul>${lists}</ul>`);   
          }
          console.log(response);
      }).catch(function(error) {
          console.log(error);
      });
  }
</script>