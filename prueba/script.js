// Array de ejemplo
const array = ['Manzana', 'Banana', 'Cereza', 'Durazno', 'Fresa', 'Uva', 'Kiwi'];

// Función para realizar la búsqueda
function buscar() {
    const termino = document.getElementById('search').value.toLowerCase();
    const resultados = document.getElementById('resultados');
    
    // Limpiar resultados previos
    resultados.innerHTML = '';

    if (termino) {
        // Filtrar el array por el término de búsqueda
        const coincidencias = array.filter(item => item.toLowerCase().includes(termino));

        // Mostrar los resultados
        if (coincidencias.length > 0) {
            coincidencias.forEach(item => {
                const li = document.createElement('li');
                li.textContent = item;
                resultados.appendChild(li);
            });
        } else {
            resultados.innerHTML = 'No se encontraron resultados.';
        }
    }
}
