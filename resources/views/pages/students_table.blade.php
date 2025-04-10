@if($students->isEmpty())
    <p>No students found for the selected criteria.</p>
@else
    <table class="w-full border-collapse border border-gray-300 mt-2">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">First Name</th>
                <th class="border p-2">Last Name</th>
                <th class="border p-2">Email</th>
                <!-- Add other headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td class="border p-2">{{ $student->fname }}</td>
                    <td class="border p-2">{{ $student->lname }}</td>
                    <td class="border p-2">{{ $student->email }}</td>
                    <!-- Add other data fields as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
