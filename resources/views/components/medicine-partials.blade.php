 @forelse($medicines as $medicine)
 <tr class="hover:bg-slate-50 border-b border-slate-200">
     <td class="p-4 py-5">
         <p class="text-sm text-slate-500">{{ $medicine->medicine_id }}</p>
     </td>
     <td class="p-4 py-5 w-[450px]">
         <p class="text-sm text-slate-500">{{ $medicine->name }}</p>
     </td>
     <td class="p-4 py-5">
         <p class="text-sm text-slate-500">{{ $medicine->quantity }} {{ $medicine->quantity < 2
                                    ? 'pc' : 'pcs' }}</p>
     </td>
     <td class="p-4 py-5 flex space-x-2">
         <button class="p-1 rounded-md hover:bg-blue-100 edit-btn"
             data-id="{{ $medicine->id }}"
             data-name="{{ $medicine->name }}"
             data-quantity="{{ $medicine->quantity }}">
             <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24" fill="currentColor">
                 <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                 <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
             </svg>
         </button>


         <form class="flex items-center p-1 rounded-md hover:bg-red-100"
             action="{{ route('medicine.destroy', $medicine) }}" method="POST"
             onsubmit="return confirm('Are you sure you want to delete this medicine?');">
             @csrf
             @method('DELETE')
             <button type="submit">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-5 h-5 text-red-400">
                     <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 
                   9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 
                   2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 
                   0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 
                   0 1 0 1.06 1.06L12 13.06l1.72 
                   1.72a.75.75 0 1 0 1.06-1.06L13.06 
                   12l1.72-1.72a.75.75 0 1 
                   0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                 </svg>
             </button>
         </form>
     </td>
 </tr>
 @empty
 <tr>
     <td colspan="7" class="p-4 text-center text-slate-500">
         No medicine found.
     </td>
 </tr>
 @endforelse