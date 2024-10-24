document.addEventListener('DOMContentLoaded', function () {
    // Инициализация элементов модального окна
    let editUnitModal = {
        modal: document.getElementById('editUnitModal'),
        label: document.getElementById('editUnitModalLabel'),
        number: document.getElementById('editUnitModalNumber'),
        image: document.getElementById('cmmImage'),
        partNumbersList: document.getElementById('partNumbersList')
    };

    // Делегирование событий для работы с контейнером
    const container = document.querySelector('.container');
    container.addEventListener('click', function (event) {
        // Добавить PN
        if (event.target.matches('#addPnField')) {
            utils.addPartNumberRow('');
        }

        // Удалить PN
        if (event.target.classList.contains('removePnField')) {
            event.target.parentElement.remove();
        }

        // Открыть модальное окно редактирования
        if (event.target.matches('.edit-unit-btn') || event.target.closest('.edit-unit-btn')) {
            const button = event.target.closest('.edit-unit-btn');
            openEditUnitModal(button, editUnitModal);
        }
    });

    // Обработчик для создания юнита
    document.getElementById('createUnitBtn').addEventListener('click', createUnit);

    // Обработчик для обновления юнита
    document.getElementById('updateUnitButton').addEventListener('click', updateUnit);

    // Обработчик для поиска с дебаунсом
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function (event) {
            console.log('Search query:', event.target.value);
        }, 300));
    }
});

// Унифицированная функция открытия модального окна редактирования
function openEditUnitModal(button, editUnitModal) {
    const manualId = button.getAttribute('data-manuals-id');
    const manualTitle = button.getAttribute('data-manual');
    const manualImage = button.getAttribute('data-manual-image');
    const manualNumber = button.getAttribute('data-manual-number');

    editUnitModal.label.innerText = `${manualTitle}`;
    editUnitModal.number.innerText = `CMM: ${manualNumber}`;
    editUnitModal.image.src = manualImage ? `/storage/image/cmm/${manualImage}` : `/storage/image/Noimage.svg`;

    editUnitModal.partNumbersList.innerHTML = '';

    // Запрос для получения юнитов, связанных с мануалом
    fetch(`units/${manualId}`)
        .then(response => response.json())
        .then(data => {
            if (data.units && data.units.length > 0) {
                data.units.forEach(unit => utils.addPartNumberRow(unit.part_number));
            } else {
                const noUnitsItem = document.createElement('div');
                noUnitsItem.className = 'mb-2';
                noUnitsItem.innerText = 'No part numbers found for this manual.';
                editUnitModal.partNumbersList.appendChild(noUnitsItem);
            }
            $('#editUnitModal').modal('show');
        })
        .catch(error => {
            console.error('Error loading units:', error);
        });
}

// Функция создания юнита
function createUnit() {
    const cmmId = document.getElementById('cmmSelect').value;
    const pnValues = Array.from(document.querySelectorAll('input[name="pn[]"]')).map(input => input.value.trim());
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const createUrl = document.getElementById('createUnitBtn').getAttribute('data-url');

    if (cmmId && pnValues.length > 0) {
        $.ajax({
            url: createUrl,
            type: 'POST',
            data: {
                cmm_id: cmmId,
                part_numbers: pnValues,
                _token: csrfToken
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while creating the unit. Please try again.');
            }
        });
    } else {
        alert('Please select CMM and enter at least one PN.');
    }
}

// Функция обновления юнита
function updateUnit() {
    const partNumbers = Array.from(document.querySelectorAll('#partNumbersList input')).map(input => input.value);
    const manualId = document.querySelector('.edit-unit-btn').getAttribute('data-manuals-id');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`units/update/${manualId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ part_numbers: partNumbers })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Units updated successfully');
                $('#editUnitModal').modal('hide');
                window.location.href = '/admin/units';
            } else {
                alert('Error updating units');
            }
        })
        .catch(error => {
            console.error('Error updating units:', error);
        });
}

// Утилитарный объект для часто используемых функций
const utils = {
    addPartNumberRow: function (partNumber = '') {
        const partNumbersList = editUnitModal.partNumbersList;

        const listItem = document.createElement('div');
        listItem.className = 'mb-2 d-flex align-items-center';

        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'forms-control';
        input.style.width = '200px';
        input.value = partNumber;

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger btn-sm ms-1 removePnField';
        deleteButton.innerText = 'Del';

        listItem.appendChild(input);
        listItem.appendChild(deleteButton);
        partNumbersList.appendChild(listItem);
    }
};

// Функция debounce для оптимизации обработки событий ввода
function debounce(func, delay) {
    let debounceTimer;
    return function () {
        const context = this;
        const args = arguments;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => func.apply(context, args), delay);
    };
}
