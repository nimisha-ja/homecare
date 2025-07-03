<input type="text" id="search-input" placeholder="Search..." style="margin-bottom: 10px; padding: 5px; width: 100%;">

<table id="payments-table" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Staff Name</th>
            <th>Payment Date</th>
            <th>Advance Amount</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>2023-03-22</td>
            <td>$1000</td>
            <td>
                <button>Edit</button> <button>Delete</button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>2023-03-21</td>
            <td>$2000</td>
            <td>
                <button>Edit</button> <button>Delete</button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Sam Brown</td>
            <td>2023-03-20</td>
            <td>$3000</td>
            <td>
                <button>Edit</button> <button>Delete</button>
            </td>
        </tr>
        <!-- More rows can be added here -->
    </tbody>
</table>

<script>
    // Search Functionality
    document.getElementById('search-input').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#payments-table tbody tr');
        
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            const text = Array.from(cells)
                .map(cell => cell.textContent.toLowerCase())
                .join(' ');

            if (text.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
