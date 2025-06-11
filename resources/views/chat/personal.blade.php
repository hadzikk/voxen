<x-app.layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:styles>
        <link rel="stylesheet" href="{{ asset('css/chat/index.scss') }}">
    </x-slot:styles>

    <div class="chat-container">
        <div class="sidebar-left">
            <div class="sidebar-left-header">
                <h1 class="greeting-user">Welcome <span class="user-fullname">Hadzik Mochamad Sofyan</span></h1>
                <div class="profile-user">
                    <figure class="user-picture-container">
                        <img src="{{ asset('images/IMG-20220709-WA0126.jpeg') }}" alt="" class="user-picture">
                    </figure>
                    <div class="user-info">    
                        <p class="username">hadzik</p> 
                        <p class="identity">You</p>
                    </div>
                </div>
            </div>

            
            <div class="sidebar-left-navbar">
                <i class="fa-solid icon-left-navbar fa-comment"></i>
                <i class="fa-solid icon-left-navbar fa-address-book"></i>
                <i class="fa-solid icon-left-navbar fa-user-plus"></i>
            </div>

            <ul>
                @foreach ($contacts as $contact)
                <li>
                    <a href="/chat/p/{{ $contact['username'] }}">
                        <figure class="contact-picture-container">
                            <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="contact-picture">
                        </figure>
                        <div class="contact-info-container">
                            <div class="contact-info">
                                <p class="contact-name">{{ $contact['username'] }}</p>
                                <p class="time">00:12</p>
                            </div>
                            <div class="contact-additional-info">
                                <p class="contact-last-chat">{{ Str::limit("p", 26, '...') }}</p>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>

        </div>

        <div class="chat-main">
            <div class="conversation-header">
                <p style="font-size: small">&copy; voxen By Hadzik Mochamad Sofyan 2025 Allrights Reserved.</p>
                <h1 class="conversation-title">You're currently in a personal chat with</h1>
                <p class="conversation-with">{{ $user['username'] }}</p>
                
                <div class="conversation-cover">
                    <figure class="conversation-picture-container">
                        <img src="{{asset('images/Deafult PFP _ @davy3k.jpg')}}" alt="" class="conversation-picture">
                    </figure>
                </div>
            </div>

            {{-- <p class="conversation-date">-Friday, 6 June 2025-</p> --}}
            <p class="conversation-date"></p>

            <div class="conversation-chat-container">
                <div class="chat-conversation-bubble">
                    <figure class="bubble-picture-container">
                        <img src="{{ asset('images/Deafult PFP _ @davy3k.jpg') }}" alt="" class="bubble-picture">
                    </figure>
                    
                    <div class="bubble-information-container">
                        <div class="bubble-information">
                            <p class="bubble-username">{{ $user['username'] }}</p>
                            <p class="bubble-time">17:01</p>
                        </div>

                        <div class="bubble-chat">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Non accusamus nobis, quia architecto excepturi vel? Fugit maiores, dicta beatae sit corporis ad. Ducimus ipsa dignissimos, nihil voluptates voluptatibus omnis veritatis?
                            Voluptatum sint fugiat quod exercitationem officia, consectetur veritatis, autem repudiandae beatae maiores nihil soluta veniam, quaerat unde! In deleniti velit vitae, aspernatur corrupti eius eveniet? Maxime quod earum porro. Rerum?
                            Vero voluptas distinctio quo minima eos maxime voluptates, assumenda repellat at! In, non impedit omnis molestias consequatur unde quidem vitae quia, possimus molestiae quaerat debitis doloribus harum id aut quo.
                            Eos velit aliquam laborum, eius nulla dignissimos! Expedita dolorum consectetur pariatur quisquam necessitatibus iusto iste, et officia perspiciatis hic sint nemo earum doloribus nisi, quae illo facilis saepe distinctio deleniti!
                            Voluptate unde ratione inventore cumque animi a blanditiis nostrum magnam necessitatibus, nihil earum repellendus deleniti consequatur eaque veritatis beatae aliquam! Neque saepe adipisci, consectetur dolorem reprehenderit quo excepturi iusto cumque?
                            Maxime, minima! Alias asperiores sit velit autem dolores possimus modi deleniti? Aut blanditiis distinctio asperiores a officia ipsam amet harum hic! Incidunt quo tempora, similique cum repudiandae doloremque! Quod, aliquam.
                            Corrupti distinctio error dicta, neque vero quidem itaque tempora voluptates dolorem. Debitis rerum repudiandae rem quisquam provident animi laborum autem ipsum, porro incidunt maiores qui ab atque voluptatibus quaerat soluta.
                            Quaerat magnam, corporis reiciendis eaque voluptate quisquam ipsam. Ex, iusto? Perspiciatis autem repellendus, ea dicta quas maiores. Nisi quidem et repellendus assumenda quo qui aspernatur odio nobis. Iusto, mollitia asperiores.
                            Est, quis voluptas! Facilis ullam dolorem consequuntur deleniti incidunt iure numquam corrupti deserunt quidem magni tenetur natus iste nihil alias atque sequi temporibus quas laboriosam, vero ut. Ad, architecto quos.
                            Corrupti rem eius earum error odio, libero laudantium laboriosam necessitatibus enim voluptatibus, voluptatem consequatur? Nisi beatae, veritatis aliquam rem cupiditate assumenda fuga amet ipsa similique doloribus facilis, quaerat dolore unde.
                            Repellat, voluptatem magnam. Dicta reprehenderit quia ullam ea! Libero placeat, reprehenderit non exercitationem fuga tenetur aliquid suscipit, vero qui vitae odio distinctio dolores! Nemo officia quod voluptates, molestias reiciendis possimus?
                            Esse, sed. Maiores, dicta quisquam nobis fugiat veniam eveniet est saepe molestias suscipit consequatur dignissimos eligendi dolore obcaecati consectetur corrupti fugit at eos illum explicabo accusamus cum voluptates. Consectetur, ad!
                            Nobis, modi aspernatur dolore hic facere doloribus sit in aliquid rem? Similique laborum quos quis. Natus, quibusdam, numquam odio provident at vel sequi autem beatae sapiente dignissimos ducimus accusamus. Totam?
                            Ratione aperiam eos officia in inventore necessitatibus provident ipsa modi qui, dolorem magnam temporibus? Dolor inventore neque tenetur numquam. Quod quasi provident pariatur, quidem impedit consectetur magni animi harum officia?
                            Esse pariatur alias harum aut, unde ipsum necessitatibus exercitationem distinctio quibusdam voluptates iusto, reiciendis quae facere doloremque eos? Ex ipsa atque est porro numquam ab officia maxime at omnis provident!
                            Culpa perspiciatis ad aliquam, animi pariatur aspernatur unde et quae! Eius temporibus inventore provident magni quaerat, error alias deserunt? Qui at odio quos placeat? Voluptate quos delectus ipsa adipisci similique.
                            Officiis aliquid consequatur repellat, nobis aperiam vel suscipit odio optio, nisi ipsa ullam neque quo eaque minus unde? Earum natus quasi molestias similique laudantium asperiores iste illo culpa nihil suscipit.
                            Ad quam sapiente neque similique blanditiis amet quas iure. Asperiores, at fugit labore commodi amet quo harum odit aspernatur quidem laborum molestiae alias ut, maxime magni neque exercitationem nostrum voluptate.
                            Veniam enim explicabo vero blanditiis dignissimos nobis, nulla impedit assumenda voluptatem. Veritatis reiciendis explicabo distinctio fuga porro voluptate nobis quam, aperiam cumque quod, vitae doloribus atque maxime? Sed, pariatur expedita?
                            Nobis, alias? Aliquam eveniet dolorem aliquid placeat temporibus obcaecati in ratione sit molestias ipsam! Expedita, voluptates, itaque perferendis blanditiis in consectetur accusantium soluta amet, quos aut molestias eveniet animi. Modi.
                            Sunt necessitatibus quasi cum voluptatibus ullam hic, architecto eaque enim quos quas reprehenderit minima laudantium iste ad nesciunt doloremque sequi sed natus nisi inventore! In ipsum debitis nemo adipisci rerum.
                            Quod porro ullam exercitationem animi quisquam magnam facere perspiciatis commodi sapiente amet facilis consequuntur numquam dolorum fugit, aliquid laudantium in corporis? Perferendis veritatis ullam doloremque omnis, odit officia provident blanditiis!
                            Voluptatibus sed dolores sequi exercitationem vel eum officiis, aspernatur nemo totam tempora! Quas maxime aliquid reprehenderit quaerat? Molestiae quibusdam dolorem deleniti quae, qui corporis fuga dignissimos placeat ducimus, tempora itaque?
                            Excepturi repellat ratione explicabo est sit sequi autem nihil vel cum! Laboriosam minima voluptatibus eligendi, sit perferendis neque numquam maxime dolor accusantium optio animi hic repudiandae iusto labore officia veritatis.
                            Quod nisi culpa omnis dolores porro aliquid totam saepe beatae officiis delectus quas perspiciatis tenetur vero, dicta rem quis animi laboriosam? Quibusdam esse minus tempore vitae architecto dolorum voluptas facilis!
                            Maiores enim cum nobis accusamus sapiente ipsum dolore consequatur repudiandae, quasi perferendis quae itaque ex, assumenda dicta voluptas voluptatum suscipit, consectetur minima animi? Quis, culpa voluptatibus voluptas ipsam eligendi beatae.
                            Distinctio, voluptate reprehenderit praesentium sapiente at, autem ipsa minima aperiam rerum quibusdam eum delectus animi nostrum esse veniam quidem ipsam facilis ut. Harum recusandae fugit suscipit unde ullam, hic reiciendis.
                            Nam, similique harum rerum magni soluta dolores repellendus quam placeat dignissimos. Ab pariatur quidem repudiandae, placeat tenetur omnis voluptatem labore magni sed reprehenderit deserunt fuga nostrum laborum harum natus iure!
                            Corporis vitae culpa quas. Ducimus, officia? Sapiente impedit laboriosam excepturi nihil accusamus similique vitae consequatur itaque ut soluta iusto modi enim illo eum accusantium totam, maiores libero in aperiam officiis?
                            Et doloremque voluptate autem provident sunt. Assumenda dolorem voluptatibus molestias tempore quisquam obcaecati voluptatem rerum blanditiis dignissimos, laborum expedita sit nihil delectus quo ducimus eaque animi. Quaerat magnam omnis qui!
                            Quasi et maxime aut, quaerat iste, saepe vero ipsum, quae rerum laboriosam ducimus! Ducimus, eum porro odit rem qui perferendis magnam voluptate deserunt saepe minima cumque officiis, corrupti cupiditate sunt!
                            Commodi unde quas, quam distinctio ullam modi aliquam fugiat praesentium. Quisquam hic explicabo molestias repudiandae, inventore aperiam delectus nisi autem. Enim sapiente optio adipisci doloribus, dolorum commodi quia doloremque ipsam.
                            Rerum impedit minus pariatur delectus quas quisquam. Molestias, nobis deleniti deserunt ducimus esse eius vitae cupiditate, doloribus delectus ullam a debitis amet blanditiis quod sed animi. Harum maiores velit saepe!
                            Neque at voluptas repellendus eius, consectetur repellat ipsa exercitationem labore quas debitis fugiat atque facilis dignissimos consequuntur perferendis, non recusandae odio tempora doloremque! Odio corrupti tempora eum debitis aliquam eveniet?
                            Molestiae aliquid iusto temporibus ad vero ea, quaerat placeat minus reiciendis amet, et veniam hic. Earum voluptatem ducimus nihil enim excepturi voluptatibus ab, at nobis rerum laboriosam! Ad, ratione sed!
                            Dolores quas itaque, quos nihil magnam debitis nisi sed velit, et mollitia asperiores, expedita fugit soluta consectetur cumque odit optio deleniti qui aliquam voluptatem! A, at! Quia qui tempore hic.
                            Harum reiciendis perferendis repellendus sequi, veniam delectus veritatis porro consequuntur, ullam, laudantium quae. Repellat, cum corrupti? Explicabo veritatis qui magni, cupiditate odio mollitia doloremque maiores officia, voluptates natus totam est.
                            Harum nam est nihil quisquam esse aliquid recusandae explicabo? Rem itaque dignissimos, accusantium ullam excepturi aperiam doloremque modi tenetur. Adipisci iusto corporis magnam odio tempore culpa rem animi itaque possimus!
                            Quibusdam architecto minima maxime repellendus et nulla iure dolores vel magni consequuntur placeat esse accusamus tempore adipisci temporibus, recusandae rem ipsum provident distinctio. Rerum blanditiis sit dignissimos eveniet. Ex, cum.
                            Doloremque minima praesentium quisquam corporis assumenda deserunt dolores vero. Odio debitis animi nostrum doloremque ipsum sunt delectus voluptatem ab optio quibusdam ipsam assumenda, mollitia laudantium possimus voluptatibus beatae repellendus suscipit?
                            Suscipit perspiciatis, nisi dolores non iure inventore tempora consequatur obcaecati, eos mollitia error quas iusto sequi quos. Nobis, natus harum. Ea voluptas soluta quaerat harum commodi obcaecati, quo nemo in!
                            Ipsam, maxime neque! Delectus voluptate itaque reiciendis laborum in? Quam ipsum temporibus eveniet exercitationem voluptatem neque pariatur vel minima, atque impedit numquam, iste amet quas cupiditate ut dignissimos, possimus molestiae.
                            Illo eaque omnis ab reiciendis animi et ad quae quisquam aliquid, vel odio repudiandae aliquam asperiores laborum harum dolor soluta! Atque eum repellendus velit tempore minus in fuga inventore sed.
                            Tempore earum recusandae cumque quidem nisi sunt labore eaque nesciunt, debitis, ullam cum sed sapiente officiis officia possimus? Quis voluptate quae placeat quasi. Perspiciatis tempore incidunt reprehenderit, ducimus necessitatibus corrupti.
                            Quidem distinctio ab earum eos necessitatibus nemo dignissimos, repudiandae natus deserunt voluptatibus aut tenetur officia beatae in ducimus ut repellat ex tempore repellendus harum? Corrupti harum officiis maiores repudiandae aliquid?
                            Similique quis reiciendis molestiae qui quam impedit aspernatur. Vel tempora, quo necessitatibus voluptatem suscipit quasi quis quod enim doloribus delectus officia totam vero porro est ullam sit ex assumenda ratione.
                            Corporis repudiandae pariatur voluptas natus debitis amet modi nam esse doloribus officiis iure quis, impedit animi laudantium beatae earum culpa quod nihil inventore repellat qui harum deserunt? Facere, necessitatibus architecto.
                            In est, dolores cumque dicta necessitatibus sed impedit tempora dignissimos pariatur omnis quos quo labore incidunt rerum delectus, voluptatum eveniet obcaecati, quis nesciunt quisquam facere provident vel aut! Corporis, unde!
                            Pariatur perferendis iure labore dolor cupiditate, earum repellendus inventore eos tenetur aspernatur? Non similique officiis a nesciunt ipsa asperiores sed? Incidunt officia voluptates veritatis rem atque ipsam voluptatibus perspiciatis numquam.
                            Distinctio iste mollitia commodi, neque minima id, maiores iure, repellendus error omnis rerum obcaecati officiis minus? Amet sed optio eaque qui aliquam assumenda provident quia numquam magni tenetur, ipsum ullam?
                            Ab facere nam error eligendi fugiat deleniti praesentium obcaecati recusandae veniam. Sunt commodi ea magnam temporibus maxime consequatur error at nobis neque quisquam cupiditate, amet necessitatibus qui quae similique exercitationem.
                            Eum voluptatum fuga nemo cum ullam hic aliquam facilis distinctio, quisquam in reprehenderit. Eveniet officiis, velit, deserunt quae saepe quas amet reiciendis temporibus nisi sit sed officia consequatur! Rem, deserunt.
                            Ipsam dolore cumque hic et, sapiente porro ea, nam suscipit nobis sequi nisi libero nihil odit provident ratione! Consequatur numquam delectus itaque ratione ipsam maxime, corrupti possimus odit atque qui?
                            Temporibus placeat ullam perspiciatis, atque illum, dicta iste eius, recusandae aut et repellendus praesentium magnam saepe laudantium autem facere doloribus libero dolorem dolorum quis repellat nemo? Sed quos vel culpa?
                            Nisi odio rem, optio nobis debitis beatae et delectus quo explicabo commodi, fugit nesciunt dolor! Facere enim voluptatem vel reiciendis labore vitae inventore, quaerat dolorem! Dolor hic possimus molestias suscipit!
                            Dignissimos esse officiis, veritatis at, laboriosam enim totam necessitatibus nam pariatur eligendi delectus earum consectetur nostrum? Possimus magni eligendi itaque tempore enim minus laborum temporibus architecto natus iste! Distinctio, mollitia?
                            Reprehenderit dicta recusandae placeat possimus eos exercitationem debitis. Illum unde hic enim ipsum suscipit, veritatis dicta quibusdam officia. Dolores magnam, temporibus porro ullam sapiente laudantium optio similique ipsam exercitationem soluta.
                            Ipsam esse aliquam non beatae ratione ea laborum ut iure incidunt deserunt placeat repudiandae fuga tempora sit eaque dolorum, blanditiis doloribus illo natus tempore modi laudantium. Placeat quisquam perspiciatis illum!
                            Nisi omnis provident quidem. Enim iusto ipsa dolore doloremque recusandae. Doloribus distinctio quis adipisci obcaecati aliquam, ducimus consequatur maiores neque perferendis, nam accusamus a animi ab sunt labore rerum quos.
                            Odio repellendus magni totam sit voluptate repellat blanditiis aspernatur culpa deserunt, tenetur nemo laborum quod soluta praesentium dignissimos velit repudiandae nostrum. Nobis ratione aut ducimus omnis error cupiditate iusto dolorem.
                        </div>
                    </div>
                </div>


            </div>

            <div class="conversation-input-container">
                <div class="input-container">
                    <div class="input-leftbar">    
                        <i class="fa-solid fa-microphone"></i>
                        <input type="text" name="" id="" class="input-message" placeholder="Type something here...">
                    </div>
                    <i class="fa-solid fa-paperclip"></i>
                </div>
            </div>
        </div>

        <div class="sidebar-right">
        </div>
    </div>
</x-app.layout>