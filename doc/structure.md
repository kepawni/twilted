[home](../README.md)

# Structure

@startuml
package \ <<internal>> {
    interface IteratorAggregate
}
package Kepawni\Twilted {
    abstract AggregateRoot {
        {abstract} #apply(:DomainEvent): void
        {abstract} #recordThat(:EventPayload): void
    }
    interface DataCarrier {
        +getPayload(): EventPayload
    }
    interface DomainEvent
    interface EntityHistory
    interface EntityIdentifier
    interface EntityReference {
        +getId(): EntityIdentifier
    }
    interface Equatable {
        +equals(:mixed): bool
    }
    interface EventPayload
    interface EventSourcedEntity {
        {static} +reconstituteFrom(:EntityHistory): EventSourcedEntity
        +getRecordedEvents(): EventStream
    }
    interface EventStream {
        +getIterator(): Traversable<DomainEvent>
    }
    interface Foldable {
        {static} +unfold(:string): Foldable
        +fold(): string
    }
    interface Recordable {
        +getRecordedOn(): DateTimeInterface
    }
    interface Windable {
        {static} +unwind(:array): Windable
        +windUp(): array
    }
    EntityReference ^.. AggregateRoot
    EventSourcedEntity ^... AggregateRoot
    DataCarrier ^-- DomainEvent
    EntityReference ^--- DomainEvent
    Recordable ^-- DomainEvent
    EntityReference ^-- EntityHistory
    EventStream ^-- EntityHistory
    Equatable ^-- EntityIdentifier
    Foldable ^-- EntityIdentifier
    Equatable ^-- EventPayload
    Windable ^-- EventPayload
    IteratorAggregate ^-- EventStream
}
@enduml
