<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div id="organigramme" class="mt-4" style="height: 600px; overflow: auto;"></div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.3.2/js/orgchart.min.js"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                let datascource = {
                    'name': 'Company Root',
                    'children': @json($employees)
                };

                let oc = $('#organigramme').orgchart({
                    'data': datascource,
                    'nodeTitle': 'name',
                    'nodeContent': 'position',
                    'draggable': true,
                    'dropCriteria': function ($draggedNode, $dragZone, $droppedNode) {
                        return true; // Allow all drops for simplicity
                    },
                    'createNode': function ($node, data) {
                        $node.find('.content').append('<i>' + data.department + '</i>');
                    },
                    'dragStart': function () {
                        console.log('drag started');
                    },
                    'dragEnd': function (event) {
                        if (event.draggable && event.droppable) {
                            let draggedId = event.draggable.attr('node-id');
                            let droppedId = event.droppable.closest('li').attr('node-id') || null;
                            let updatedEmployees = @json($employees).map(emp => {
                                if (emp.id == draggedId) {
                                    return { ...emp, manager_id: droppedId };
                                }
                                return emp;
                            });
                            Livewire.emit('updateEmployees', updatedEmployees);
                            Livewire.emit('updateHierarchy');
                        }
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.3.2/css/orgchart.min.css">
    @endpush
</div>