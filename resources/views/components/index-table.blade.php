@props([
    'icon' => 'bi-list',
    'title',
    'createRoute' => null,
    'searchAction' => null,
    'columns', // ex: ['Nom' => 'nom', 'Prénom' => 'prenom']
    'data',
    'resource' // ex: 'consultations'
])

<div class="container-fluid py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0 text-primary fw-bold">
            <i class="bi {{ $icon }} me-2"></i> {{ $title }}
        </h2>
        @if ($createRoute)
            <a href="{{ $createRoute }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-dotted"></i> Ajouter une {{ Str::singular($resource) }}
            </a>
        @endif
    </div>

    {{-- Search --}}
    @if ($searchAction)
        <form method="GET" action="{{ $searchAction }}" class="mb-3 w-50">
            <input type="text" name="search" class="form-control" placeholder="🔍 Rechercher une {{ Str::singular($resource) }}..." value="{{ request('search') }}" oninput="this.form.submit()">
        </form>
    @endif

    {{-- Table --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light text-uppercase text-secondary small">
                        <tr>
                            <th>#</th>
                            @foreach ($columns as $label => $field)
                                <th>{{ $label }}</th>
                            @endforeach
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                @foreach ($columns as $field)
                                    <td>{{ Str::limit(data_get($item, $field), 40) }}</td>
                                @endforeach
                                <td class="text-end">
                                    <a href="{{ route($resource . '.show', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route($resource . '.edit', $item->id) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route($resource . '.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + 2 }}" class="text-center text-muted py-4 fst-italic">
                                    Aucune {{ Str::singular($resource) }} trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="card-footer bg-white d-flex justify-content-center py-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
