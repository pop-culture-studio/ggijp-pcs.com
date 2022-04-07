<x-main-layout>
    <x-slot name="title">
        {{ __('お問い合わせプレビュー') }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="font-semibold text-xl leading-tight">
                {{ __('お問い合わせプレビュー') }}
            </h2>

            <div class="bg-white overflow-hidden p-3 prose prose-xl prose-a:text-indigo-500">
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
                        <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    </tr>
                    <tr>
                        <th>本文</th>
                        <td>{!! nl2br(e($contact->body)) !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-main-layout>
