<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Ver</h1>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="https://ui-avatars.com/api/?name={{ $ticket->contact->name }}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $ticket->contact->name }}</h3>

                    <p class="text-muted text-center">{{ $ticket->contact->company->name }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>{{ $ticket->tag->name }}</b> <i class="fas fa-circle float-right"
                                style="color:{{ $ticket->tag->color }};"></i>
                        </li>
                        <li class="list-group-item">
                            <b>Asignado a:</b> <span
                                class="text-muted float-right">{{ $ticket->assignedTo->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Creado por:</b> <span
                                class="text-muted float-right">{{ $ticket->createdBy->name }}</span>
                        </li>
                    </ul>

                    <a href="#" class="btn btn-primary btn-block"><b>Finalizar</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-9">
            <!-- About Me Box -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Información capturada</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="far fa-calendar-check mr-1"></i> Actividad a realizar</strong>

                    <x-form-select name="activity_id" :bind="$ticket" class="border-0 shadow-sm mt-3"
                        :options="$activities" />

                    <hr>

                    <strong><i class="far fa-comment-alt mr-1"></i> Notas</strong>

                    <p class="text-muted">
                        {{ $ticket->note }}
                    </p>

                    <hr>

                    <strong><i class="far fa-comment-dots mr-1 mb-3"></i> Comentarios</strong> <span class="badge badge-dark">{{ $ticket->comments()->count() }}</span>

                    @if ($ticket->comments()->exists())
                        @foreach ($ticket->comments as $comment)
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">{{ $comment->user->name }}</span>
                                    <span class="direct-chat-timestamp float-right">{{ $comment->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img"
                                    src="https://ui-avatars.com/api/?name={{ $comment->user->name }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    {{ $comment->message }}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->
                        @endforeach
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="{{ route('tickets.comment', $ticket) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Agrega un comentario ..."
                                class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

</x-main-layout>
