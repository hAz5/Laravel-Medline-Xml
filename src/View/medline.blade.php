<?xml version="1.0" encoding="utf-8"?>
    <!DOCTYPE ArticleSet PUBLIC "-//NLM//DTD PubMed 2.7//EN" "https://dtd.nlm.nih.gov/ncbi/pubmed/in/PubMed.dtd">
<ArticleSet>
    <Article>
        <Journal>
            <PublisherName>{{ config('medline.publisher_name') }}</PublisherName>
            <JournalTitle>{{ $medline->journal_title }}</JournalTitle>
            <Issn>{{ $medline->issn }}</Issn>
            <Volume>{{ $medline->volume }}</Volume>
            <Issue>{{ $medline->issue }}</Issue>
            <PubDate PubStatus="ppublish">
                <Year>{{ $medline->ppub_date->year }}</Year>
                <Month>{{ $medline->ppub_date->month }}</Month>
            </PubDate>
        </Journal>
        <ArticleTitle>{{ $medline->title }}</ArticleTitle>
        @if( $medline->firstPage && $medline->lastPage)
        <FirstPage>{{ $medline->firstPage }}</FirstPage>
        <LastPage>{{ $medline->lastPage }}</LastPage>
        @endif
        @if ($medline->doi)
        <ELocationID EIdType="doi">{{ $medline->doi }}</ELocationID>
        @else
        <ELocationID EIdType="pii">e-{{ $medline->document_id }}</ELocationID>
        @endif
        <Language>{{ $medline->lang }}</Language>
        <AuthorList>
            @foreach($medline->authors as $author)
            <Author>
                @if($author->first_name)
                <FirstName>{{ $author->first_name }}</FirstName>
                @endif
                @if($author->middle_name)
                <MiddleName>{{ $author->middle_name }}</MiddleName>
                @endif
                @if($author->last_name)
                <LastName>{{ $author->last_name }}</LastName>
                @endif
                @if(is_array($author->affiliations))
                @foreach($author->affiliations as $affiliation)
                <AffiliationInfo>
                    <Affiliation>{{ $affiliation }}</Affiliation>
                </AffiliationInfo>
                @endforeach
                @elseif($author->affiliations != '')
                <AffiliationInfo>
                    <Affiliation>{{ $author->affiliations }}</Affiliation>
                </AffiliationInfo>
                @endif
            </Author>
            @endforeach
        </AuthorList>
        <PublicationType>{{ $medline->type }}</PublicationType>
        <ArticleIdList>
            @if ($medline->doi)
            <ArticleId IdType="doi">{{ $medline->doi }}</ArticleId>
            @else
            <ArticleId IdType="pii">e-{{ $medline->document_id }}</ArticleId>
            @endif
        </ArticleIdList>
        <History>
            <PubDate PubStatus="accepted">
                <Year>{{ $medline->accepted_date->year }}</Year>
                <Month>{{ $medline->accepted_date->month }}</Month>
                <Day>{{ $medline->accepted_date->day }}</Day>
            </PubDate>
            <PubDate PubStatus="received">
                <Year>{{ $medline->received_date->year }}</Year>
                <Month>{{ $medline->received_date->month }}</Month>
                <Day>{{ $medline->received_date->day }}</Day>
            </PubDate>
            <PubDate PubStatus="epublish">
                <Year>{{ $medline->epub_date->year }}</Year>
                <Month>{{ $medline->epub_date->month }}</Month>
                <Day>{{ $medline->epub_date->day }}</Day>
            </PubDate>
            <PubDate PubStatus="ppublish">
                <Year>{{ $medline->ppub_date->year }}</Year>
                <Month>{{ $medline->ppub_date->month }}</Month>
                <Day>{{ $medline->ppub_date->day }}</Day>
            </PubDate>
        </History>
        <Abstract>
            @if(is_array($medline->abstract))
                @foreach($medline->abstract as $abstract)
                <AbstractText Label="{{ $abstract->type }}">{{ $abstract->text }}</AbstractText>
                @endforeach
            @else
            {{ $medline->abstract }}
            @endif
        </Abstract>
        <CopyrightInformation>{{ $medline->getCopyright()}}</CopyrightInformation>
        <CoiStatement>{{ $medline->coi }}</CoiStatement>
        <ObjectList>
            @foreach($medline->getkeywords() as $keyword)
            @if($keyword)
            <Object Type="keyword">
                <Param Name="value">{{ $keyword }}</Param>
            </Object>
            @endif
            @endforeach
        </ObjectList>
    </Article>
</ArticleSet>
