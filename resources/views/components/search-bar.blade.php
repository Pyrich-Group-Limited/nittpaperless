<style>
    .search-hover {
    border: 1px solid #ccc;
    outline: none;
    background-size: 22px;
    background-position: 13px;
    border-radius: 10px;
    width: 50px;
    height: 40px;
    padding: 25px;
    transition: all 0.5s;
    margin-bottom: 10px;
  }

  /* .search-hover:hover {
    width: 300px;
    padding-left: 50px;
  } */

  .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            margin: 20px;
            min-width: 40px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            text-align: center;
        }
        #closeSearch{
            position: absolute;
            right: 100px;
        }
</style>

<div class="mt-2" wire:ignore>
    <div class="input-icons">
        <a href="#" onclick="event.preventDefault(); closeSearch();" wire:click="clearSearch"  style="display: none" id="closeSearch"><i class="ti ti-x h6 icon text-danger"></i></a>
        <a href="#" onclick="event.preventDefault(); searchRecord();" id="showSearch"><i class="fa fa-search h6 icon text-success"></i></a>
        <input {{ $attributes }} type="text" class="search-hover" name="" placeholder="search here..." />
    </div>
</div>

<script>
    function searchRecord(){
        const boxes = Array.from(
            document.getElementsByClassName('search-hover')
        );

        boxes.forEach(box => {
            box.style.width = '100%';
            box.style.paddingLeft = '50px';
        });
        const box = document.getElementById('closeSearch');
        box.style.display = '';

        const searchIcon = document.getElementById('showSearch');
        searchIcon.style.display = 'none';

    }

    function closeSearch(){
        const boxes = Array.from(
            document.getElementsByClassName('search-hover')
        );

        boxes.forEach(box => {
            box.style.width = '50px';
            box.style.paddingLeft = '25px';
        });
        const box = document.getElementById('closeSearch');
        box.style.display = 'none';

        const searchIcon = document.getElementById('showSearch');
        searchIcon.style.display = '';

    }
</script>
