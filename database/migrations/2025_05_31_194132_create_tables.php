<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("create table if not exists movies (
            id bigint not null generated always as identity,
            movie_name varchar(255) not null,
            created_at timestamp(0) not null default now()::timestamp(0),
            updated_at timestamp(0) not null default now()::timestamp(0),
            constraint movies_id primary key (id)
        )");

        DB::statement("create table if not exists theaters (
            id bigint not null generated always as identity,
            theater_name varchar(255) not null,
            created_at timestamp(0) not null default now()::timestamp(0),
            updated_at timestamp(0) not null default now()::timestamp(0),
            constraint theaters_id primary key (id)
)");
        DB::statement("create table if not exists movie_theater (
            id bigint not null generated always as identity,
            movie_id bigint not null,
            theater_id bigint not null,
            sales decimal(12, 2) not null,
            show_date date not null,
            created_at timestamp(0) not null default now()::timestamp(0),
            updated_at timestamp(0) not null default now()::timestamp(0),
            constraint movie_theater_id primary key (id),
            constraint movie_theater_movie_id foreign key (movie_id) references movies (id),
            constraint movie_theater_theater_id foreign key (theater_id) references theaters (id)
);");
        DB::statement("create unique index if not exists movie_theater_movie_id_theater_id_show_date_idx on movie_theater (movie_id, theater_id, show_date)");

        DB::statement("insert into movies (movie_name) values
            ('Movie 1'),
            ('Movie 2')");

        DB::statement("insert into theaters (theater_name) values
            ('Theater 1'),
            ('Theater 2')");

        DB::statement("insert into movie_theater (movie_id, theater_id, sales, show_date) values
            (1, 1, 26000.00,'2025-06-01'),
            (1, 2, 36000.00,'2025-06-01'),
            (2, 1, 40000.00,'2025-06-01'),
            (2, 2, 12300.00,'2025-06-01'),
            (1, 1, 16000.00,'2025-06-02'),
            (1, 2, 66000.00,'2025-06-02'),
            (2, 1, 9000.00,'2025-06-02'),
            (2, 2, 102300.00,'2025-06-02')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("drop table if exists movie_theater");
        DB::statement("drop table if exists movies");
        DB::statement("drop table if exists theaters");
    }
};
