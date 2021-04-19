<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if ($notifications->count() >= 1)
                <span class="badge badge-danger navbar-badge">{{ $notifications->count() }}</span>
            @endif
            </a>
            @if ($notifications->count() >= 1)
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notifications->count() }} Notificaciones</span>
                @foreach ($notifications as $notification)
                    <div class="dropdown-divider"></div>
                    <button wire:click="show({{ $notification->data['ticket'] }}, '{{ $notification->id }}')" type="button" class="dropdown-item">
                        <i class="{{ $notification->data['icon'] }} mr-2"></i> {{ $notification->data['message'] }}
                        <span class="float-right text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                    </button>
                @endforeach
                <div class="dropdown-divider"></div>
                <button type="button" wire:click="readAll" class="dropdown-item dropdown-footer">Marcar como
                    leídas</button>
            </div>
            @endif
        </li>
</div>
