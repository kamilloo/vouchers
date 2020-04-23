@extends('front.partials.page')

@section('content-page')
    <section class="featured-area pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="single-feature d-flex flex-wrap justify-content-between">

                        <h3 class="title text-uppercase pb-10">Regulamin serwisu <a href="{{ route('welcome') }}"><u>{{ route('welcome') }}</u><strong>&nbsp;</strong></a>.</h3>

                        <p>Regulamin określa zasady i warunki korzystania z Serwisu internetowego {{ route('welcome') }}, a&nbsp;także warunki i zasady dokonywania zakupów produktów dostępnych w ramach Serwisu internetowego.</p>

                        <h6 class="title text-uppercase">§ 1 Postanowienia wstępne.</h6>
                        <ol>
                            <li>Każdy Użytkownik jest zobowiązany zapoznać się z treścią niniejszego Regulaminu, co potwierdza, korzystając z funkcjonalności Serwisu internetowego.</li>
                            <li>Każdy Kupujący w Serwisie internetowym jest zobowiązany zapoznać się z treścią niniejszego Regulaminu, co Kupujący potwierdza, dokonując zakupu w serwisie internetowym.</li>
                        </ol>

                        <h6 class="title text-uppercase" style="width: 100%">§ 2 Definicje.</h6>

                        <p>Użyte w Regulaminie definicje należy rozumieć następująco:</p>
                                <ol>
                                    <li><strong>Serwis internetowy</strong> – Strona internetowa Sprzedawcy działająca pod adresem {{ route('welcome') }}</li>
                                    <li><strong>Sprzedawca</strong> – będący oferentem bonów, osoba fizyczna posiadająca pełną zdolność do czynności prawnych lub osoba o ograniczonej zdolności do czynności prawnych, jeżeli posiada zgodę swojego przedstawiciela ustawowego na dokonanie czynności prawnych lub osoba prawna albo inna jednostka organizacyjna nieposiadająca osobowości prawnej, działająca przez osobę umocowaną, która korzysta z funkcjonalności Serwisu internetowego. Pełna lista sprzedawców podana §13 niniejszego regulaminu.</li>
                                    <li><strong>Użytkownik </strong>– osoba fizyczna posiadająca pełną zdolność do czynności prawnych lub osoba o ograniczonej zdolności do czynności prawnych, jeżeli posiada zgodę swojego przedstawiciela ustawowego na dokonanie czynności prawnych lub osoba prawna albo inna jednostka organizacyjna nieposiadająca osobowości prawnej, działająca przez osobę umocowaną, która korzysta z funkcjonalności Serwisu internetowego.</li>
                                    <li><strong>Właściciel</strong> – Kamil Piętka, ul. Mossego 2, Grodzisk Wlkp.</li>
                                    <li><strong>Kupujący </strong>– Użytkownik, który korzysta z usług i funkcjonalności Serwisu, a w szczególności dokonujący zakupów za pośrednictwem Serwisu.</li>
                                    <li><strong>Konsument</strong> – osoba fizyczna zawierająca ze Sprzedawcą umowę w ramach Serwisu, której przedmiot nie jest związany bezpośrednio z jej działalnością gospodarczą lub zawodową.</li>
                                    <li><strong>Przedsiębiorca</strong> – Użytkownik lub Kupujący wykonujący działalność gospodarczą w rozumieniu przepisów ustawy z dnia 6 marca 2018 r. – Prawo przedsiębiorców.</li>
                                    <li><strong>Zamówienie</strong> – oświadczenie woli Kupującego składane za pomocą Formularza zamówienia i&nbsp;zmierzające bezpośrednio do zawarcia Umowy sprzedaży ze&nbsp;Sprzedawcą.</li>
                                    <li><strong>Produkt</strong> – dostępny w Serwisie produkt lub usługa będąca przedmiotem Umowy sprzedaży między Kupującym a Sprzedawcą.</li>
                                    <li><strong>Operator płatności</strong> – System płatności https://www.przelewy24.pl/</li>
                                    <li><strong>Umowa zawarta na odległość </strong>– umowa zawarta z Kupującym w ramach zorganizowanego systemu zawierania umów na odległość (w ramach Serwisu), bez jednoczesnej fizycznej obecności stron w tym samym miejscu i czasie, z wyłącznym wykorzystaniem jednego lub większej liczby środków porozumiewania się na odległość do chwili zawarcia umowy włącznie.</li>
                                    <li><strong>Konto </strong>– konto Kupującego w Serwisie, są w nim gromadzone dane podane przez Kupującego oraz informacje o złożonych przez niego Zamówieniach w Serwisie.</li>
                                    <li><strong>Formularz zamówienia</strong> – interaktywny formularz dostępny w Serwisie umożliwiający złożenie Zamówienia, w szczególności poprzez dodanie Produktów do elektronicznego koszyka oraz określenie warunków Umowy zawartej na odległość, w tym sposobu dostawy i płatności</li>
                                    <li><strong>Regulamin</strong> – niniejszy regulamin Serwisu.</li>
                                </ol>

                        <h6 class="title text-uppercase" style="width: 100%">§ 3 Kontakt.</h6>

                                <ol>
                                    <li>Kupujący może kontaktować się ze Właścicielem w szczególności:
                                        <ol>
                                            <li>za pośrednictwem poczty elektronicznej, na adres: kamil.pietka85@gmail.com</li>
                                            <li>pisemnie na adres: Kamil Pietka, ul. Mossego 2, 62-065 Grodzisk Wlkp.</li>
                                            <li>a także telefonicznie pod numerem: +48662362356 w godz. 9.00 – 17.00 w dni robocze.</li>
                                        </ol>
                                    </li>
                                </ol>

                        <h6 class="title text-uppercase" style="width: 100%">§ 4 Zagadnienia techniczne.</h6>

                                <ol>
                                    <li>Do korzystania z Serwisu internetowego, niezbędne są:
                                        <ol>
                                            <li>urządzenie końcowe z dostępem do sieci Internet i przeglądarką internetową,</li>
                                            <li>oraz aktywne konto poczty elektronicznej (tylko w przypadku składania zamówień).</li>
                                        </ol>
                                    </li>
                                    <li>Sprzedawca w najszerszym dopuszczalnym przez prawo zakresie nie ponosi odpowiedzialności za zakłócenia, w tym przerwy w funkcjonowaniu Serwisu internetowego spowodowane siłą wyższą, niedozwolonym działaniem osób trzecich lub niekompatybilnością Serwisu internetowego z infrastrukturą techniczną Kupującego.</li>
                                    <li>Właścicielowi przysługuje prawo do przerwy technicznej w funkcjonowaniu Serwisu internetowego, niezbędnej dla planowanej, bieżącej obsługi i konserwacji serwera oraz oprogramowania Serwisu. W&nbsp;przypadku planowanej przerwy Kupujący zostaną o tym wyraźnie powiadomieni na stronie Serwisu.</li>
                                </ol>

                        <h6 class="title text-uppercase">§ 5 Zasady składania Zamówienia.</h6>

                                <ol>
                                    <li>Przeglądanie oferty Serwisu nie wymaga zakładania Konta.</li>
                                    <li>Składanie zamówień przez Kupującego na Produkty oferowane przez Sprzedawców możliwe jest przez podanie niezbędnych danych osobowych i adresowych umożliwiających realizację Zamówienia bez zakładania Konta.
                                    </li>
{{--                                    <li>Założenie Konta w Serwisie jest bezpłatne.</li>--}}
{{--                                    <li>W celu złożenia Zamówienia, jeśli wybrano opcję złożenia <strong>zamówienia bez rejestracji</strong>, należy:--}}
{{--                                        <ol>--}}
{{--                                            <li>wybrać Produkt będący przedmiotem Zamówienia, a następnie kliknąć 'dalej',</li>--}}
{{--                                            <li>wypełnić Formularz zamówienia, wpisując dane odbiorcy Zamówienia oraz adresu, wybrać rodzaj przesyłki (sposób dostarczenia Produktu, jeśli dotyczy danego Produktu),</li>--}}
{{--                                            <li>wpisać dane do faktury, jeśli są inne niż dane odbiorcy Zamówienia,</li>--}}
{{--                                            <li>wybrać jeden z dostępnych sposobów płatności i kliknąć przycisk „Kupuję i płacę”,</li>--}}
{{--                                            <li>potwierdzić zamówienie, dokonując płatności w określonym terminie, w wybrany wcześniej sposób, z zastrzeżeniem § 7 pkt 3.</li>--}}
{{--                                        </ol>--}}
{{--                                    </li>--}}
{{--                                    <li>W celu złożenia Zamówienia, jeśli wybrano opcję złożenia <strong>zamówienia z rejestracją</strong> (założeniem Konta), należy:--}}
{{--                                        <ol>--}}
{{--                                            <li>wybrać Produkt będący przedmiotem Zamówienia, a następnie kliknąć przycisk „dalej”,</li>--}}
{{--                                            <li>przy pierwszym zamówieniu wypełnić Formularz zamówienia, wpisując dane odbiorcy Zamówienia oraz adresu, na który ma nastąpić dostawa Produktu, wybrać rodzaj przesyłki (sposób dostarczenia Produktu, jeśli dotyczy danego Produktu) oraz zaznaczyć pole „Stworzyć konto?”,</li>--}}
{{--                                            <li>wpisać dane do faktury, jeśli są inne niż dane odbiorcy Zamówienia,</li>--}}
{{--                                            <li>wybrać jeden z dostępnych sposobów płatności i kliknąć przycisk „Kupuję i płacę”,</li>--}}
{{--                                            <li>potwierdzić zamówienie, dokonując płatności, w wybrany wcześniej sposób.</li>--}}
{{--                                        </ol>--}}
{{--                                    </li>--}}
{{--                                    <li>Przy kolejnych zamówieniach logowanie się Konta jest możliwe poprzez podanie loginu i hasła ustanowionych w Formularzu rejestracji.</li>--}}
{{--                                    <li>Kupujący ma możliwość w każdej chwili, bez podania przyczyny i bez ponoszenia z tego tytułu jakichkolwiek opłat, usunąć Konto poprzez wysłanie stosownego żądania do Sprzedawcy, w szczególności za pośrednictwem poczty elektronicznej lub pisemnie na adres podany w § 3.</li>--}}
                                </ol>
                        <h6 class="title text-uppercase">§ 6 Ceny Produktów i kwota do zapłaty.</h6>

                                <ol>
                                    <li>Wszystkie ceny w Serwisie są wyrażone w polskich złotych i są cenami brutto.</li>
                                    <li>Na całkowitą kwotę do zapłaty przez Kupującego składa się cena za Produkt oraz koszt dostawy (jeśli Produkt wymaga fizycznego dostarczenia), o&nbsp;której Kupujący jest informowany na stronach Serwisie w trakcie składania Zamówienia, w tym także w chwili wyrażenia woli przystąpienia do Umowy Sprzedaży.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 7 Oferowane metody dostawy oraz płatności.</h6>

                                <ol>
                                    <li>Kupujący może skorzystać z następujących metod dostawy lub odbioru zamówionego Produktu:
                                        <ol>
                                            <li>w przypadku produktów niematerialnych – przesyłka drogą elektroniczną</li>
                                            <li>w przypadku Produktów materialnych:
                                                <ol>
                                                    <li>przesyłka pocztowa,</li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </li>
                                    <li>Kupujący może wybrać z następujących metod płatności:
                                        <ol>
                                            <li>płatność przelewem na konto Sprzedawcy oraz</li>
                                            <li>płatności elektroniczne.</li>
                                        </ol>
                                    </li>
                                    <li>Szczegółowe informacje na temat metod dostawy oraz akceptowalnych metod płatności znajdują się za stronach Serwisu i w formularzu zamówienia.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 8 Wykonanie umowy sprzedaży</h6>

                                <ol>
                                    <li>W celu zakupu Produktu Kupujący powinien wykonać następujące czynności:
                                        <ol>
                                            <li>wypełnić Formularz zamówienia, podając wymagane dane oraz wybierając sposób płatności,</li>
                                            <li>zaakceptować warunki Regulaminu,</li>
                                            <li>kliknąć w przycisk „Zatwierdź”.</li>
                                        </ol>
                                    </li>
                                    <li>Po kliknięciu przycisku “Zatwierdź”,
                                        <ol>
                                            <li>przy płatności przelewem bankowym na konto Sprzedawcy, Kupujący zostanie przekierowany do strony z potwierdzeniem otrzymania zamówienia.</li>
                                            <li>przy płatności za pośrednictwem płatności elektronicznych, Kupujący zostanie przeniesiony na stronę Operatora płatności w celu dokonania zapłaty ceny za wybrane Produkty</li>
                                        </ol>
                                    </li>
                                    <li>Po skutecznym dokonaniu płatności, Kupujący zostanie przeniesiony na stronę z potwierdzeniem zakupu. Potwierdzenie zakupu zostanie przesłane Kupującemu również na adres e-mail podany w Formularzu zamówienia.</li>
                                    <li>Z chwilą dokonania płatności Umowę uważa się za zawartą między Kupującym a Sprzedawcą.</li>
                                    <li>Dostawa kupionego Produktu lub świadczenie usługi następuje w sposób wybrany przez Kupującego.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 9 Reklamacje</h6>

                                <ol>
                                    <li>Mając na uwadze dobre obyczaje i słuszny interes Kupujących, w przypadku zastrzeżeń co do zakupionego Produktu Kupujący ma prawo do złożenia reklamacji.</li>
                                    <li>Kupujący składa reklamację w formie pisemnej na wybrany adres podany w §3 Regulaminu</li>
                                    <li>Reklamacja powinna zawierać, konkretne zarzuty wraz z uzasadnieniem.</li>
                                    <li>Termin rozpatrzenia reklamacji przez Sprzedawcę to maksymalnie 14 dni od dnia jej złożenia.</li>
                                    <li>Brak odpowiedzi Właściciela w ww. terminie na złożoną prawidłowo reklamację, oznacza uznanie reklamacji przez Sprzedającego.</li>
                                    <li>W przypadku uznania reklamacji, Sprzedawca wykona ponownie Usługę lub&nbsp;dostarczy nowy Produkt, nie pobierając dodatkowej opłaty. W przypadku, jeśli nie będzie to możliwe, Sprzedawca zwróci Kupującemu poniesione za zamówienie opłaty.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 10 Prawo odstąpienia od umowy</h6>

                                <ol>
                                    <li>Kupujący, będący konsumentem, który zawarł ze Sprzedawcą umowę na odległość, może w&nbsp;terminie 14 dni,
                                        <ol>
                                            <li>w przypadku Produktów fizycznych – od objęcia Produktu w posiadanie przez Kupującego lub osoby trzecie przez niego wskazane z wyjątkiem przewoźnika (np. poczta),</li>
                                            <li>w pozostałych przypadkach – od dnia zawarcia umowy,<br>
                                                odstąpić od Umowy sprzedaży bez podania jakiejkolwiek przyczyny.</li>
                                        </ol>
                                    </li>
                                </ol>
                                <ol start="2">
                                    <li>W celu odstąpienia od umowy, Kupujący powinien poinformować Sprzedawcę o zamiarze odstąpienia od umowy w drodze oświadczenia woli w formie pisma wysłanego pocztą elektroniczną lub pocztą na adres podany w §3 Regulaminu.</li>
                                    <li>Informację o odstąpieniu od umowy należy przesłać przed upływem terminu do odstąpienia od umowy określonym w §11 pkt.1.</li>
                                    <li>W przypadku odstąpienia od umowy Sprzedawca zwraca Kupującemu wszystkie otrzymane od&nbsp;Kupującego płatności, nie później niż 14 dni od dnia, w którym Sprzedawca został poinformowany o odstąpieniu Kupującego od Umowy.</li>
                                    <li>Zwrotu płatności Sprzedawca dokona przy&nbsp;użyciu takich samych metod płatności, jakie zostały przez Kupującego użyte w pierwotnej transakcji, chyba że Konsument wyraźnie zgodził się na inne rozwiązanie, które nie będzie się&nbsp;wiązało dla niego z&nbsp;żadnymi kosztami.</li>
                                </ol>
                                <p><strong>[SYTUACJE, W KTÓRYCH NIE PRZYSŁUGUJE PRAWO ODSTĄPIENIA OD UMOWY]</strong></p>
                                <ol start="7">

                                    <li>Prawo do odstąpienia od umowy zawartej na odległość nie przysługuje Konsumentowi również w&nbsp;odniesieniu do Umowy o dostarczenie treści cyfrowych, które nie są zapisane na nośniku materialnym, jeżeli spełnianie świadczenia rozpoczęło się za wyraźną zgodą Konsumenta przed upływem terminu do odstąpienia od umowy i po poinformowaniu go przez Sprzedawcę o utracie prawa odstąpienia od Umowy.</li>
                                    <li>Konsumentowi nie przysługuje prawo odstąpienia od umowy o świadczenie usług, jeżeli Sprzedawca wykonał w pełni usługę za wyraźną zgodą konsumenta, który został poinformowany przed rozpoczęciem świadczenia, że po spełnieniu świadczenia przez przedsiębiorcę utraci prawo odstąpienia od umowy.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 11 Pozasądowe sposoby rozpatrywania reklamacji i dochodzenia roszczeń</h6>

                                <ol>
                                    <li>Sprzedawca wyraża zgodę na poddanie ewentualnych sporów wynikłych w związku z&nbsp;zawartymi umowami na odległość na drodze postępowania mediacyjnego. Szczegóły zostaną określone przez strony konfliktu.</li>
                                    <li>Konsument posiada następujące przykładowe możliwości skorzystania z pozasądowych sposobów rozpatrywania reklamacji i dochodzenia roszczeń. Między innymi, Konsument ma możliwość:
                                        <ol>
                                            <li>zwrócenia się do stałego polubownego sądu konsumenckiego z wnioskiem o&nbsp;rozstrzygnięcie sporu wynikłego z Umowy zawartej ze Sprzedawcą,</li>
                                            <li>do zwrócenia się do wojewódzkiego inspektora Inspekcji Handlowej, z wnioskiem o&nbsp;wszczęcie postępowania mediacyjnego w sprawie polubownego zakończenia sporu między Konsumentem a Sprzedawcą,</li>
                                            <li>skorzystania z bezpłatnej pomocy w sprawie rozstrzygnięcia sporu między nim a&nbsp;Sprzedawcą, korzystając także z bezpłatnej pomocy powiatowego (miejskiego) rzecznika konsumentów lub organizacji społecznej, do której zadań statutowych należy ochrona konsumentów np. Stowarzyszenie Konsumentów Polskich.</li>
                                            <li>Kupujący ma prawo skorzystać z pozasądowych sposobów rozpatrywania reklamacji i&nbsp;dochodzenia roszczeń. W tym celu może złożyć skargę za pośrednictwem unijnej platformy internetowej ODR dostępnej pod adresem: <a href="http://ec.europa.eu/consumers/odr/" class="snppopup">http://ec.europa.eu/consumers/odr/</a>.</li>
                                        </ol>
                                    </li>
                                    <li>Szczegółowe informacje dotyczące możliwości skorzystania przez Konsumenta z&nbsp;pozasądowych sposobów rozpatrywania reklamacji i dochodzenia roszczeń oraz zasady dostępu do tych procedur dostępne są w siedzibach oraz na stronach internetowych powiatowych (miejskich) rzeczników konsumentów, organizacji społecznych, do których zadań statutowych należy ochrona konsumentów, Wojewódzkich Inspektoratów Inspekcji Handlowej oraz na stronie internetowej Urzędu Ochrony Konkurencji i Konsumentów.</li>
                                </ol>
                        <h6 class="title text-uppercase">§ 12 Dane osobowe i pliki Cookies</h6>

                                <p>Zasady przetwarzania danych osobowych oraz wykorzystywania plików cookies zostały opisane w Polityce prywatności i plików cookies dostępnej pod adresem <a href="{{ route('privacy') }}"><u>{{ route('privacy') }}</u><strong>&nbsp;</strong></a></p>

                        <h6 class="title text-uppercase" style="width: 100%">§ 13 Lista sprzedawców</h6>
                        <ol>
                            <li class="pb-2">Gabinet Kosmetyki Pielęgnacyjnej Katarzyna Piętka, ul. Mossego 2, Grodzisk Wlkp., NIP: 995-013-76-23, REGON: 302612554</li>
                        </ol>

                        <h6 class="title text-uppercase" style="width: 100%">§ 14 Postanowienia końcowe</h6>

                                <ol>
                                    <li>Umowy zawierane poprzez Serwis internetowy zawierane są w języku polskim.</li>
                                    <li>W sprawach nieuregulowanych w niniejszym Regulaminie mają zastosowanie powszechnie obowiązujące przepisy prawa polskiego, w szczególności: Kodeksu cywilnego; Prawa przedsiębiorców; ustawy o świadczeniu usług drogą elektroniczną; ustawy o prawach konsumenta oraz ogólnego rozporządzenia o ochronie danych oraz <strong>ustawy o ochronie danych osobowych.</strong></li>
                                    <li>Właściciel zastrzega sobie prawo do dokonywania zmian Regulaminu z ważnych przyczyn, tj.: zmiany przepisów prawa, zmiany sposobów płatności i dostaw, w zakresie, w jakim te zmiany wpływają na realizację postanowień niniejszego Regulaminu. Zmiany wchodzą w życie z dniem ich publikacji w Serwisie.</li>
                                    <li>Do umów zawartych przed zmianą Regulaminu stosuje się wersję Regulaminu obowiązującą w dacie zawarcia umowy.</li>
                                    <li><strong>Niniejszy Regulamin obowiązuje od 20. kwietnia 2020 r. </strong></li>
                                </ol>
                                <p>&nbsp;</p>
                            </div><!--/row-->
                        </div>
                    </div>
                </div>
    </section>
@endsection
