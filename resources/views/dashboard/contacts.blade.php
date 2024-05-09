<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('お問い合わせ一覧') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="py-3">お問い合わせメールの記録用。メールが届いてない時（もしくはメールを見られない人）はここで確認。</div>

            @forelse($contacts as $contact)

                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-3 mb-3">

                    <table class="table-auto">
                        <tr>
                            <th>日時</th>
                            <td>{{ $contact->created_at }}</td>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        <tr>
                            <th>メール</th>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>本文</th>
                            <td>{!! nl2br(e($contact->body)) !!}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td><a href="{{ URL::temporarySignedRoute('contact.preview', now()->addDay(), $contact) }}" class="text-indigo-500 underline">プレビュー</a></td>
                        </tr>
                    </table>
                </div>

            @empty
                <div class="p-3">お問い合わせはありません。</div>
            @endforelse

            <div class="flex justify-center">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
