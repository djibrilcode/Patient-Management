@props([
    'data',
    'searchAction',
    'sortField' => null,
    'sortDirection' => 'asc',
])

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>
                    <a href="{{ route('users.index', array_merge(request()->query(), [
                        'sort_field' => 'name',
                        'sort_direction' => $sortField === 'name' && $sortDirection === 'asc' ? 'desc' : 'asc',
                    ])) }}">
                        Nom
                        @if($sortField === 'name')
                            <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Email</th>
                <th>
                    <a href="{{ route('users.index', array_merge(request()->query(), [
                        'sort_field' => 'role',
                        'sort_direction' => $sortField === 'role' && $sortDirection === 'asc' ? 'desc' : 'asc',
                    ])) }}">
                        Rôle
                        @if($sortField === 'role')
                            <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Créé le</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge 
                            @if($user->role == 'admin') bg-danger
                            @elseif($user->role == 'medecin') bg-primary
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-success" title="Modifier">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"
                                        title="Supprimer">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">Aucun utilisateur trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center mt-4">
        {{ $data->appends(request()->query())->links() }}
    </div>
@endif
