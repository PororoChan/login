PGDMP         *                z            siswa    14.1    14.1 '               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16543    siswa    DATABASE     h   CREATE DATABASE siswa WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE siswa;
                postgres    false            ?            1259    16750    biodata    TABLE     ?   CREATE TABLE public.biodata (
    id_data integer NOT NULL,
    nama character varying(255) NOT NULL,
    kelas character varying(255) NOT NULL,
    usia character varying(255) NOT NULL,
    gambar character varying(255) NOT NULL
);
    DROP TABLE public.biodata;
       public         heap    postgres    false            ?            1259    16749    biodata_id_data_seq    SEQUENCE     ?   CREATE SEQUENCE public.biodata_id_data_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.biodata_id_data_seq;
       public          postgres    false    216                       0    0    biodata_id_data_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.biodata_id_data_seq OWNED BY public.biodata.id_data;
          public          postgres    false    215            ?            1259    16734    dtsiswa    TABLE     ?   CREATE TABLE public.dtsiswa (
    id_siswa integer NOT NULL,
    nama character varying(255) NOT NULL,
    kelas character varying(255) NOT NULL,
    usia character varying(255) NOT NULL
);
    DROP TABLE public.dtsiswa;
       public         heap    postgres    false            ?            1259    16733    dtsiswa_id_siswa_seq    SEQUENCE     ?   CREATE SEQUENCE public.dtsiswa_id_siswa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.dtsiswa_id_siswa_seq;
       public          postgres    false    212                       0    0    dtsiswa_id_siswa_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.dtsiswa_id_siswa_seq OWNED BY public.dtsiswa.id_siswa;
          public          postgres    false    211            ?            1259    16950    file_upload    TABLE     ?   CREATE TABLE public.file_upload (
    userid integer NOT NULL,
    publisher character varying(255) NOT NULL,
    file_name character varying(255) NOT NULL,
    description character varying(255) NOT NULL
);
    DROP TABLE public.file_upload;
       public         heap    postgres    false            ?            1259    16949    file_upload_userid_seq    SEQUENCE     ?   CREATE SEQUENCE public.file_upload_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.file_upload_userid_seq;
       public          postgres    false    218                       0    0    file_upload_userid_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.file_upload_userid_seq OWNED BY public.file_upload.userid;
          public          postgres    false    217            ?            1259    16743    kelas    TABLE     h   CREATE TABLE public.kelas (
    id_kelas integer NOT NULL,
    kelas character varying(255) NOT NULL
);
    DROP TABLE public.kelas;
       public         heap    postgres    false            ?            1259    16742    kelas_id_kelas_seq    SEQUENCE     ?   CREATE SEQUENCE public.kelas_id_kelas_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.kelas_id_kelas_seq;
       public          postgres    false    214                       0    0    kelas_id_kelas_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.kelas_id_kelas_seq OWNED BY public.kelas.id_kelas;
          public          postgres    false    213            ?            1259    16716    login    TABLE     ?   CREATE TABLE public.login (
    id_user integer NOT NULL,
    nama character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL
);
    DROP TABLE public.login;
       public         heap    postgres    false            ?            1259    16715    login_id_user_seq    SEQUENCE     ?   CREATE SEQUENCE public.login_id_user_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.login_id_user_seq;
       public          postgres    false    210                       0    0    login_id_user_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.login_id_user_seq OWNED BY public.login.id_user;
          public          postgres    false    209            s           2604    16753    biodata id_data    DEFAULT     r   ALTER TABLE ONLY public.biodata ALTER COLUMN id_data SET DEFAULT nextval('public.biodata_id_data_seq'::regclass);
 >   ALTER TABLE public.biodata ALTER COLUMN id_data DROP DEFAULT;
       public          postgres    false    215    216    216            q           2604    16737    dtsiswa id_siswa    DEFAULT     t   ALTER TABLE ONLY public.dtsiswa ALTER COLUMN id_siswa SET DEFAULT nextval('public.dtsiswa_id_siswa_seq'::regclass);
 ?   ALTER TABLE public.dtsiswa ALTER COLUMN id_siswa DROP DEFAULT;
       public          postgres    false    211    212    212            t           2604    16953    file_upload userid    DEFAULT     x   ALTER TABLE ONLY public.file_upload ALTER COLUMN userid SET DEFAULT nextval('public.file_upload_userid_seq'::regclass);
 A   ALTER TABLE public.file_upload ALTER COLUMN userid DROP DEFAULT;
       public          postgres    false    217    218    218            r           2604    16746    kelas id_kelas    DEFAULT     p   ALTER TABLE ONLY public.kelas ALTER COLUMN id_kelas SET DEFAULT nextval('public.kelas_id_kelas_seq'::regclass);
 =   ALTER TABLE public.kelas ALTER COLUMN id_kelas DROP DEFAULT;
       public          postgres    false    214    213    214            p           2604    16719    login id_user    DEFAULT     n   ALTER TABLE ONLY public.login ALTER COLUMN id_user SET DEFAULT nextval('public.login_id_user_seq'::regclass);
 <   ALTER TABLE public.login ALTER COLUMN id_user DROP DEFAULT;
       public          postgres    false    210    209    210                      0    16750    biodata 
   TABLE DATA           E   COPY public.biodata (id_data, nama, kelas, usia, gambar) FROM stdin;
    public          postgres    false    216   ?)                 0    16734    dtsiswa 
   TABLE DATA           >   COPY public.dtsiswa (id_siswa, nama, kelas, usia) FROM stdin;
    public          postgres    false    212   4*                 0    16950    file_upload 
   TABLE DATA           P   COPY public.file_upload (userid, publisher, file_name, description) FROM stdin;
    public          postgres    false    218   m*                 0    16743    kelas 
   TABLE DATA           0   COPY public.kelas (id_kelas, kelas) FROM stdin;
    public          postgres    false    214   ?*                 0    16716    login 
   TABLE DATA           B   COPY public.login (id_user, nama, username, password) FROM stdin;
    public          postgres    false    210   +                  0    0    biodata_id_data_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.biodata_id_data_seq', 93, true);
          public          postgres    false    215                        0    0    dtsiswa_id_siswa_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.dtsiswa_id_siswa_seq', 52, true);
          public          postgres    false    211            !           0    0    file_upload_userid_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.file_upload_userid_seq', 63, true);
          public          postgres    false    217            "           0    0    kelas_id_kelas_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.kelas_id_kelas_seq', 34, true);
          public          postgres    false    213            #           0    0    login_id_user_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.login_id_user_seq', 27, true);
          public          postgres    false    209            |           2606    16757    biodata biodata_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.biodata
    ADD CONSTRAINT biodata_pkey PRIMARY KEY (id_data);
 >   ALTER TABLE ONLY public.biodata DROP CONSTRAINT biodata_pkey;
       public            postgres    false    216            x           2606    16741    dtsiswa dtsiswa_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.dtsiswa
    ADD CONSTRAINT dtsiswa_pkey PRIMARY KEY (id_siswa);
 >   ALTER TABLE ONLY public.dtsiswa DROP CONSTRAINT dtsiswa_pkey;
       public            postgres    false    212            ~           2606    16957    file_upload file_upload_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.file_upload
    ADD CONSTRAINT file_upload_pkey PRIMARY KEY (userid);
 F   ALTER TABLE ONLY public.file_upload DROP CONSTRAINT file_upload_pkey;
       public            postgres    false    218            z           2606    16748    kelas kelas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.kelas
    ADD CONSTRAINT kelas_pkey PRIMARY KEY (id_kelas);
 :   ALTER TABLE ONLY public.kelas DROP CONSTRAINT kelas_pkey;
       public            postgres    false    214            v           2606    16723    login login_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.login
    ADD CONSTRAINT login_pkey PRIMARY KEY (id_user);
 :   ALTER TABLE ONLY public.login DROP CONSTRAINT login_pkey;
       public            postgres    false    210               {   x?E?=?@@?z??`3??ΔƊ?`caBv?5a	?x{?2?~?h???<??Mյ'?!??]`[[?^??I?Ob2????:?h???>?????S????%"???p`ɉ✼?j]&?)D???!?         )   x?35?J?.??WN,)ʬ????T
p?44?????? ???         V   x?33?J?.??WN,)ʬ??L??+???+HI?t3\ܸ̌9????9#1??7??4'?+?,?-??3/S,? ?????? ???         "   x?36???T
p?26?????M ,g?=... ??         ?   x?M̻?0 @љ~?3?,?`@yԸ`??T)(??????.n??r???P?C?eXW??RT????F??Q蒱?
Xq???$??&~2V)=???????X???t4^?@?$bX?X??L&???N;??????1?Mj|"?3??ʬ?m???S???FzE?>?Y |?8     